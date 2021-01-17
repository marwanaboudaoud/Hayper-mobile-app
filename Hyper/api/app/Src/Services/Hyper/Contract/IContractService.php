<?php



namespace App\Src\Services\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Support\Collection;

interface IContractService
{
    /**
     * @param int $id
     * @return EmployeeContractModel
     */
    public function find(int $id);

    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return mixed
     */
    public function export(EmployeeContractModel $employeeContractModel);
    /**
     * @param PaginationContractModel $paginationContractModel
     * @return PaginationContractModel
     */
    public function get(PaginationContractModel $paginationContractModel);

    /**
     * @param UserModel $userModel

     */
    public function generatePdf(UserModel $userModel);
}
