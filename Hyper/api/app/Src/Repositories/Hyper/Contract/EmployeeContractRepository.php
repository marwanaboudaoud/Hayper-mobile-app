<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Mappers\Hyper\Contract\EmployeeContractEloquentMapper;
use App\Src\Mappers\Hyper\Contract\EmployeeContractModelMapper;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use Illuminate\Support\Collection;

class EmployeeContractRepository implements IEmployeeContractRepository
{
    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return EmployeeContractModel
     * @throws \Exception
     */
    public function store(EmployeeContractModel $employeeContractModel)
    {
        $contract = EmployeeContractModelMapper::toEloquentModel($employeeContractModel);

        $contract->save();

        return EmployeeContractEloquentMapper::toEmployeeContractModel($contract);
    }

    /**
     * @param int $id
     * @return EmployeeContractModel|mixed
     * @throws \Exception
     */
    public function find(int $id)
    {
        $contract = EmploymentContract::find($id);

        if (!$contract) {
            return null;
        }

        return EmployeeContractEloquentMapper::toEmployeeContractModel($contract);
    }

    /**
     * @inheritDoc
     */
    public function findByUserId(int $userId)
    {
        $employeeContracts = EmploymentContract::where('user_id', $userId)->get();

        return EmployeeContractEloquentMapper::toCollectionEmployeeContractModel($employeeContracts);
    }
}
