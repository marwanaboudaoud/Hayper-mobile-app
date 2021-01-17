<?php

namespace App\Exceptions\Employee;

use Exception;
use Throwable;

class ActivateTokenNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Activate token not set!', 500);
    }
}
