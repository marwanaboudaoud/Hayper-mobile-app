<?php

namespace App\Src\Services\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryDayModel;

interface ISalaryDayStoreService
{
    /**
     * @param SalaryDayModel $salaryDayModel
     * @return SalaryDayModel
     */
    public function store(SalaryDayModel $salaryDayModel);
}
