<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\SalaryDay;
use App\SalaryRow;
use App\Src\Mappers\Hyper\Salary\SalaryDayEloquentMapper;

class SalaryManualRepository implements ISalaryManualRepository
{
    /**
     * @param int $id
     * @return \App\Src\Models\Hyper\Salary\SalaryDayModel
     */
    public function find(int $id)
    {
        $salaryManual = SalaryDay::where('id', $id)
            ->where('is_manual', 1)->first();

        return SalaryDayEloquentMapper::toModel($salaryManual);
    }
}
