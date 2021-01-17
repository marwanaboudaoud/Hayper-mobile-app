<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractModel;

interface IEmployeeContractDeleteRepository
{
    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}
