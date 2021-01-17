<?php

namespace App\Exceptions\Nmbrs;

use Exception;
use Throwable;

class NmbrsDefaultEnvNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Nmbrs default env not set exception', 500);
    }
}
