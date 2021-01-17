<?php


namespace App\Src\Services\Hyper\Employee;

use App\Src\Models\Hyper\Employee\EmployeeActivateModel;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;

interface IEmployeeService
{
    /**
     * @param  $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param PaginationEmployeeModel $paginationModel
     * @return mixed
     */
    public function get(PaginationEmployeeModel $paginationModel);
}
