<?php

namespace App\Exceptions\Employee;

use Exception;

class EmployeeNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Employee does not exist", 404, null);
    }
}
