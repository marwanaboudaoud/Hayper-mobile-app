<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;

interface ISalaryRepository
{
    public function find(int $id);

    public function get(SalaryPaginationModel $salaryPaginationModel);
}
