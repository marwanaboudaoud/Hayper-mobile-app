<?php


namespace App\Src\Mappers\Hyper\Contract;

use App\EmploymentContractAction;
use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;

class EmployeeContractActionEloquentMapper
{
    public static function toModel(EmploymentContractAction $employmentContractAction)
    {
        return (new EmployeeContractActionModel())
            ->setExtended($employmentContractAction->is_extended)
            ->setOldContractId($employmentContractAction->contract_id)
            ->setNewContractId($employmentContractAction->new_contract_id);
    }
}
