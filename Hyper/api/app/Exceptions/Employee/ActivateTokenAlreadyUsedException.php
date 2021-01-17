<?php

namespace App\Exceptions\Employee;

use Exception;
use Throwable;

class ActivateTokenAlreadyUsedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Activate token already used!', 409);
    }
}
