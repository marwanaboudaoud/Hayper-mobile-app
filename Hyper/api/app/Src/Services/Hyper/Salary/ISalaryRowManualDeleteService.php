<?php


namespace App\Src\Services\Hyper\Salary;

interface ISalaryRowManualDeleteService
{
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
