<?php

namespace App\Exceptions\Availability;

use Exception;
use Throwable;

class DateExceededExpireDate extends Exception
{
    public function __construct()
    {
        parent::__construct("Date exceeded expire date!", 409);
    }
}
