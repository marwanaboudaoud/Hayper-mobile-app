<?php


namespace App\Src\Repositories\App\Financial;

use App\Salary;
use App\Src\Mappers\Hyper\Salary\SalaryEloquentMapper;
use Carbon\Carbon;

class MonthCloseRepository implements IFinancialCloseRepository
{
    /**
     * @param Carbon $date
     * @return mixed
     */
    protected function getIds(Carbon $date)
    {
        $ids = Salary::select('id')
            ->Month($date->month)
            ->Year($date->year)
            ->IsNotClosed()
            ->get()
            ->pluck('id');

        return $ids;
    }


    /**
     * @param Carbon $date
     * @return \Illuminate\Support\Collection
     */
    public function close(Carbon $date)
    {
        $ids = $this->getIds($date);
        $salaries = Salary::whereIn('id', $ids)->get();

        Salary::whereIn('id', $ids)->update([
            'is_closed' => true
        ]);

        return SalaryEloquentMapper::toCollectionModel($salaries);
    }
}
