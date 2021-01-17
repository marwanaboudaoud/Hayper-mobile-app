<?php


namespace App\Src\Services\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryDayModel;

interface ISalaryManualService
{
    /**
     * @param int $id
     * @return SalaryDayModel
     */
    public function find(int $id);
}
