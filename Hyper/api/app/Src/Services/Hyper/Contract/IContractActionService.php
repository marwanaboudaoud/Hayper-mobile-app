<?php


namespace App\Src\Services\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;

interface IContractActionService
{
    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @return mixed
     */
    public function createOrDelete(EmployeeContractActionModel $contractActionModel);

    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @param EmployeeContractModel $employeeContractModel
     * @return mixed
     */
    public function extendCurrentContract(
        EmployeeContractActionModel $contractActionModel,
        EmployeeContractModel $employeeContractModel
    );

    /**
     * @param EmployeeContractModel $contractModel
     * @return bool
     */
    public function delete(
        EmployeeContractModel $contractModel
    );
}
