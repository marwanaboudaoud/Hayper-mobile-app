<?php


namespace App\Src\Repositories\App\Financial;

use App\Salary;
use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MonthOpenRepository implements IFinancialOpenRepository
{
    /**
     * @param SalaryModel $salaryModel
     * @return bool|mixed
     */
    public function store(SalaryModel $salaryModel)
    {
        $salary = SalaryModelMapper::toEloquent($salaryModel);
        $salary->save();
        return true;
    }
}
