<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;

interface IEmployeeContractActionRepository
{
    public function store(EmployeeContractActionModel $contractActionModel);
}
