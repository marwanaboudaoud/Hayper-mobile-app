<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Employee\EmployeeActivateRequest;
use App\Src\Models\Hyper\Employee\EmployeeActivateModel;

class EmployeeActivateRequestMapper
{
    public static function toModel(EmployeeActivateRequest $employeeActivateRequest)
    {
        return (new EmployeeActivateModel())
            ->setToken($employeeActivateRequest->token)
            ->setPassword($employeeActivateRequest->password)
            ->setPasswordRepeat($employeeActivateRequest->password_confirmation);
    }
}
