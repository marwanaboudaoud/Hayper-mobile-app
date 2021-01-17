<?php

namespace App\Exceptions\Availability;

use Exception;
use Throwable;

class NoAvailableDriveException extends Exception
{
    public function __construct()
    {
        parent::__construct("No available driver found for that day", 404);
    }
}
