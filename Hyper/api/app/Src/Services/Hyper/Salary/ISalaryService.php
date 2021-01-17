<?php


namespace App\Src\Services\Hyper\Salary;

use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use App\Src\Models\Hyper\Salary\SalaryModel;

interface ISalaryService
{
    /**
     * @param int $id
     * @return SalaryModel
     */
    public function find(int $id);

    public function get(SalaryPaginationModel $salaryPaginationModel);
}
