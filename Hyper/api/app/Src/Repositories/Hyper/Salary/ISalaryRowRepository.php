<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryRowModel;

interface ISalaryRowRepository
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getSubTotalPerDayBonusBySalaryId(int $id);

    public function getSubTotalPerDayExclBonusBySalaryId(int $id);

    public function getSubTotalPerDayInclBonusBySalaryId(int $id);

    public function store(SalaryRowModel $salaryRowModel);
}
