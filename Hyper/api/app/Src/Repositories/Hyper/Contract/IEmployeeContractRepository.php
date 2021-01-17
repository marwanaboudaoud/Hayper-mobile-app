<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use Illuminate\Support\Collection;

interface IEmployeeContractRepository
{
    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return mixed
     */
    public function store(EmployeeContractModel $employeeContractModel);

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param int $userId
     * @return Collection
     */
    public function findByUserId(int $userId);
}
