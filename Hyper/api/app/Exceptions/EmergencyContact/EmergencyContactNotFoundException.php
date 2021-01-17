<?php

namespace App\Exceptions\EmergencyContact;

use Exception;

class EmergencyContactNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Emergency contact not found!', 404);
    }
}
