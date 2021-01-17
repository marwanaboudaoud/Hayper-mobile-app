<?php

namespace App\Exceptions\Address;

use Exception;
use Throwable;

class AddressNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Address not found!', 404);
    }
}
