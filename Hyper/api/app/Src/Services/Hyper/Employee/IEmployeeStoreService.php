<?php


namespace App\Src\Services\Hyper\Employee;

use App\Src\Models\Hyper\User\UserModel;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;

interface IEmployeeStoreService
{
    public function store(UserModel $userModel);
}
