<?php


namespace App\Src\Mappers\Request\Contract;

use App\Http\Requests\Contract\EmployeeContractRequest;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;

class EmployeeContractRequestMapper
{
    public static function toModel(EmployeeContractRequest $employeeContractRequest)
    {
        return (new EmployeeContractModel())
            ->setId($employeeContractRequest->contract_id);
    }
}
