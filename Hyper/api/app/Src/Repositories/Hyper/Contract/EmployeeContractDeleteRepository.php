<?php


namespace App\Src\Repositories\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;

class EmployeeContractDeleteRepository implements IEmployeeContractDeleteRepository
{
    public function delete(int $id)
    {
        $employeeContract = EmploymentContract::with('employmentContractActions')
            ->where('id', $id)->first();

        $employeeContract->employmentContractActions()->delete();
        $employeeContract->delete();

        return true;
    }
}
