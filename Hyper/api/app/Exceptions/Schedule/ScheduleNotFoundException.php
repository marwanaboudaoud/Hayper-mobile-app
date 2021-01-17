<?php

namespace App\Exceptions\Schedule;

use Exception;

class ScheduleNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Schedule is not found!", 404, null);
    }
}
