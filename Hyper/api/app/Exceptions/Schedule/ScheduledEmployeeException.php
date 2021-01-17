<?php

namespace App\Exceptions\Schedule;

use Exception;
use Throwable;

class ScheduledEmployeeException extends Exception
{
    public function __construct()
    {
        parent::__construct("Employee is all ready scheduled to work that day", 404);
    }
}
