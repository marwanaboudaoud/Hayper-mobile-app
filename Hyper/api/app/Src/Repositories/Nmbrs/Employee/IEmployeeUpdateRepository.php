<?php


namespace App\Src\Repositories\Nmbrs\Employee;

use App\Src\Models\Hyper\User\UserModel;

interface IEmployeeUpdateRepository
{
    public function update(UserModel $userModel);
}
