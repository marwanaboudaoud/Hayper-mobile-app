<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\SalaryDay;
use App\SalaryRow;
use App\Src\Mappers\Hyper\Salary\SalaryDayEloquentMapper;
use App\Src\Mappers\Hyper\Salary\SalaryRowEloquentDeleteMapper;
use App\Src\Mappers\Hyper\Salary\SalaryRowEloquentMapper;

class SalaryManualDeleteRepository implements ISalaryManualDeleteRepository
{

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id)
    {
        $salaryManual = SalaryDay::where([
            'id' => $id,
            'is_manual' => true
        ])->first();

        $salaryManual->salaryRows()->delete();
        $salaryManual->delete();
    }
}
