<?php

namespace App\Exceptions\Employee;

use Exception;
use Throwable;

class EmployeeAddressModelNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Employee address model not set!', 500);
    }
}
