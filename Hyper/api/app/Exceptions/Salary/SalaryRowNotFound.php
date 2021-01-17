<?php

namespace App\Exceptions\Salary;

use Exception;
use Throwable;

class SalaryRowNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct("Salary row not found", 404);
    }
}
