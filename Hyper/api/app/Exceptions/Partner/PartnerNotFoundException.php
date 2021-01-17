<?php

namespace App\Exceptions\Partner;

use Exception;
use Throwable;

class PartnerNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Partner not found!', 404);
    }
}
