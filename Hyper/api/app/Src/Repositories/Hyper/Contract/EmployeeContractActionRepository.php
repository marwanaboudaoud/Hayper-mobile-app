<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Mappers\Hyper\Contract\EmployeeContractActionEloquentMapper;
use App\Src\Mappers\Hyper\Contract\EmployeeContractActionModelMapper;
use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;

class EmployeeContractActionRepository implements IEmployeeContractActionRepository
{
    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @return EmployeeContractActionModel
     */
    public function store(EmployeeContractActionModel $contractActionModel)
    {
        $contract = EmployeeContractActionModelMapper::toEloquent($contractActionModel);
        $contract->save();
        return EmployeeContractActionEloquentMapper::toModel($contract);
    }
}
