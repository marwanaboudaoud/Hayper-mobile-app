<?php

namespace App\Exceptions\Token;

use Exception;
use Throwable;

class TokenNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct("Token is not set", 409);
    }
}
