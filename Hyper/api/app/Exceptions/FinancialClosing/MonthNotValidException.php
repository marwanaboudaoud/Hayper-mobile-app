<?php

namespace App\Exceptions\FinancialClosing;

use Exception;

class MonthNotValidException extends Exception
{
    public function __construct()
    {
        parent::__construct('Months are between 1 and 12.', 500);
    }
}
