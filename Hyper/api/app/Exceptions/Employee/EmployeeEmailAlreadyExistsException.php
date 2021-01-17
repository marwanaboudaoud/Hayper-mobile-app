<?php

namespace App\Exceptions\Employee;

use Exception;

class EmployeeEmailAlreadyExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Email already exists", 409, null);
    }
}
