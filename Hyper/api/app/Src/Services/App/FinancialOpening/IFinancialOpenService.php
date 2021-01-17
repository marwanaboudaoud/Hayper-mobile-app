<?php


namespace App\Src\Services\App\FinancialOpening;

use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface IFinancialOpenService
{
    /**
     * @param SalaryModel $salaryModel
     * @return mixed
     */
    public function store(SalaryModel $salaryModel);

    /**
     * @param Collection $collection
     * @return mixed
     */
    public function storeCollection(Collection $collection);
}
