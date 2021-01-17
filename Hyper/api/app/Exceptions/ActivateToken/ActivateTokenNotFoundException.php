<?php

namespace App\Exceptions\ActivateToken;

use Exception;
use Throwable;

class ActivateTokenNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Activate token not found!', 404);
    }
}
