<?php


namespace App\Src\Repositories\Hyper\Salary;

interface ISalaryManualDeleteRepository
{
    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
