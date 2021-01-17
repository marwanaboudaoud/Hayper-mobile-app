<?php

namespace App\Exceptions\Salary;

use Exception;
use Throwable;

class SalaryDeleteException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            "Salary row, cannot be deleted. Because salary row is not added manually",
            409
        );
    }
}
