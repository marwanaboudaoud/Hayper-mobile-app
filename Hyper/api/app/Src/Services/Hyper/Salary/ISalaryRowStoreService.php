<?php

namespace App\Src\Services\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryRowModel;
use Illuminate\Support\Collection;

interface ISalaryRowStoreService
{
    public function store(SalaryRowModel $salaryRowModel);

    public function storeBatch(Collection $collection);
}
