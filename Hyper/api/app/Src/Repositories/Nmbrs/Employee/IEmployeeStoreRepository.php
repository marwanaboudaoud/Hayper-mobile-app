<?php


namespace App\Src\Repositories\Nmbrs\Employee;

use App\Src\Models\Hyper\User\UserModel;

interface IEmployeeStoreRepository
{
    public function store(UserModel $userModel);
}
