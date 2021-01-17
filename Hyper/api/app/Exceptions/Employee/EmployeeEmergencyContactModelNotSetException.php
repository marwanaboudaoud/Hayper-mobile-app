<?php

namespace App\Exceptions\Employee;

use Exception;

class EmployeeEmergencyContactModelNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Employee emergency model not set!', 500);
    }
}
