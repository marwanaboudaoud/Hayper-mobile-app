<?php


namespace App\Src\Mappers\Hyper\Contract;

use App\EmploymentContractAction;
use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;

class EmployeeContractActionModelMapper
{
    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @return EmploymentContractAction
     */
    public static function toEloquent(EmployeeContractActionModel $contractActionModel)
    {
        $contract = new EmploymentContractAction();
        $contract->contract_id = $contractActionModel->getOldContractId();
        $contract->new_contract_id = $contractActionModel->getNewContractId();
        $contract->is_extended = $contractActionModel->isExtended();


        return $contract;
    }
}
