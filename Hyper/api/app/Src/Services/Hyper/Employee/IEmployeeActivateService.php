<?php


namespace App\Src\Services\Hyper\Employee;

use App\Src\Models\Hyper\Employee\EmployeeActivateModel;

interface IEmployeeActivateService
{
    public function activate(EmployeeActivateModel $activateModel);
}
