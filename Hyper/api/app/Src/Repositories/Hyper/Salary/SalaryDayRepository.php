<?php

 namespace App\Src\Repositories\Hyper\Salary;

use App\Src\Mappers\Hyper\Salary\SalaryDayEloquentMapper;
use App\Src\Mappers\Hyper\Salary\SalaryDayModelMapper;
use App\Src\Models\Hyper\Salary\SalaryDayModel;

class SalaryDayRepository implements ISalaryDayRepository
{
    /**
     * @param SalaryDayModel $salaryDayModel
     * @return SalaryDayModel
     */
    public function store(SalaryDayModel $salaryDayModel)
    {
        $eloquentModel = SalaryDayModelMapper::toEloquentModel($salaryDayModel);
        $eloquentModel->save();

        return SalaryDayEloquentMapper::toModel($eloquentModel);
    }
}
