<?php

namespace App\Src\Repositories\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryDayModel;

interface ISalaryDayRepository
{
    /**
     * @param SalaryDayModel $salaryDayModel
     * @return SalaryDayModel
     */
    public function store(SalaryDayModel $salaryDayModel);
}
