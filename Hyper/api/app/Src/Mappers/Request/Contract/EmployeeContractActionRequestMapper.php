<?php


namespace App\Src\Mappers\Request\Contract;

use App\Http\Requests\Contract\EmployeeContractActionRequest;
use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;

class EmployeeContractActionRequestMapper
{
    /**
     * @param EmployeeContractActionRequest $contractActionRequest
     * @return mixed
     */
    public static function toModel(EmployeeContractActionRequest $contractActionRequest)
    {
        return (new EmployeeContractActionModel())
            ->setExtended($contractActionRequest->is_extended)
            ->setOldContractId($contractActionRequest->contract_id);
    }
}
