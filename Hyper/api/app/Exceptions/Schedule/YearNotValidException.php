<?php

namespace App\Exceptions\Schedule;

use Exception;
use Throwable;

class YearNotValidException extends Exception
{
    public function __construct()
    {
        parent::__construct('First year is 2020', 500);
    }
}
