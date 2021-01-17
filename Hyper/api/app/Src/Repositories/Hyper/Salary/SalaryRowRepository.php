<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\SalaryDay;
use App\Src\Mappers\Hyper\Salary\SalaryRowEloquentMapper;
use App\Src\Mappers\Hyper\Salary\SalaryRowModelMapper;
use App\Src\Mappers\Hyper\Salary\SalaryTotalPerDayStdMapper;
use App\Src\Models\Hyper\Salary\SalaryRowModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SalaryRowRepository implements ISalaryRowRepository
{
    protected function baseSubtotalPerDay(\Closure $queryClosure = null)
    {
        $query = DB::table('salaries')
            ->join('salary_days', 'salaries.id', '=', 'salary_days.salary_id')
            ->join('salary_rows', 'salary_days.id', '=', 'salary_rows.salary_day_id')
            ->select(DB::raw('salary_days.id, salary_days.date, sum(amount*price) AS total_sales'));

        if ($queryClosure) {
            $query = $queryClosure($query);
        }

        return $query;
    }

    protected function baseSubTotalPerDayById(int $id, \Closure $queryClosure = null)
    {
        return $this->baseSubtotalPerDay($queryClosure)
            ->where('salaries.id', $id);
    }

    protected function getSubTotalPerDayBonusBySalaryIdQuery(int $id, $bonus = false)
    {
        return $this->baseSubTotalPerDayById($id, function ($query) use ($bonus) {
            return $query->where('is_bonus', $bonus)->where('is_manual', false);
        });
    }

    /**
     * @param int $id
     * @return Collection|mixed
     */
    public function getSubTotalPerDayBonusBySalaryId(int $id)
    {
        $subTotalPerDay = $this->getSubTotalPerDayBonusBySalaryIdQuery($id, true)
            ->groupBy(['salary_days.id'])
            ->get();

        return SalaryTotalPerDayStdMapper::toModelCollection($subTotalPerDay);
    }

    public function getSubTotalPerDayExclBonusBySalaryId(int $id)
    {
        $subTotalPerDay = $this->getSubTotalPerDayBonusBySalaryIdQuery($id, false)
            ->groupBy(['salary_days.id'])
            ->get();

        return SalaryTotalPerDayStdMapper::toModelCollection($subTotalPerDay);
    }

    public function getSubTotalPerDayInclBonusBySalaryId(int $id)
    {
        $subTotalPerDay = $this->baseSubtotalPerDay()
            ->groupBy(['salary_days.id'])
            ->get();

        return SalaryTotalPerDayStdMapper::toModelCollection($subTotalPerDay);
    }

    public function store(SalaryRowModel $salaryRowModel)
    {
        $model = SalaryRowModelMapper::toEloquentModel($salaryRowModel);
        $model->save();

        return SalaryRowEloquentMapper::toModel($model);
    }
}
