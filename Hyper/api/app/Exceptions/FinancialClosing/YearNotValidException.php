<?php

namespace App\Exceptions\FinancialClosing;

use Exception;

class YearNotValidException extends Exception
{
    public function __construct()
    {
        parent::__construct('First year is 2020', 500);
    }
}
