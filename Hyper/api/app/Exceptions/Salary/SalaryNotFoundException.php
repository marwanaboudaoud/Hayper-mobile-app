<?php

namespace App\Exceptions\Salary;

use Exception;
use Throwable;

class SalaryNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Salary not found!', 404);
    }
}
