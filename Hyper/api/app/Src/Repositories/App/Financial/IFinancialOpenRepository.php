<?php


namespace App\Src\Repositories\App\Financial;

use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;

interface IFinancialOpenRepository
{
    /**
     * @param SalaryModel $salaryModel
     * @return mixed
     */
    public function store(SalaryModel $salaryModel);
}
