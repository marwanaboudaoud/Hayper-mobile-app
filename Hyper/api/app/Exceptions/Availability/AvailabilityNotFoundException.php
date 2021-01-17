<?php

namespace App\Exceptions\Availability;

use Exception;
use Throwable;

class AvailabilityNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Availability not found!', 404);
    }
}
