<?php

namespace App\Exceptions\AvailabilityShift;

use Exception;
use Throwable;

class AvailabilityShiftNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Availability shift not found!", 404);
    }
}
