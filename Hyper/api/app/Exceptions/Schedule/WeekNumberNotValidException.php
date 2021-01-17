<?php

namespace App\Exceptions\Schedule;

use Exception;
use Throwable;

class WeekNumberNotValidException extends Exception
{
    public function __construct($weekNr, $maxWeekNr)
    {
        parent::__construct(
            'Week number ' . $weekNr .
            '. Week numbers must be numbers between 1 and ' . $maxWeekNr,
            500
        );
    }
}
