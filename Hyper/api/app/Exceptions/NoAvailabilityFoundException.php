<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NoAvailabilityFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("No availability found exception!", 404);
    }
}
