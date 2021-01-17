<?php


namespace App\Src\Services\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractModel;

interface IContractStoreService
{
    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return mixed
     */
    public function store(EmployeeContractModel $employeeContractModel);
}
