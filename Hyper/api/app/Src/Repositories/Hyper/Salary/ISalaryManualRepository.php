<?php


namespace App\Src\Repositories\Hyper\Salary;

interface ISalaryManualRepository
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);
}
