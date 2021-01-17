<?php

namespace App\Exceptions\SalaryRowManual;

use Exception;
use Throwable;

class SalaryClosedException extends Exception
{
    public function __construct()
    {
        parent::__construct("Salary already closed!", 409);
    }
}
