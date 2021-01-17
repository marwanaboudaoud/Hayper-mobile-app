<?php

namespace App\Exceptions\Auth;

use Exception;
use Throwable;

class UserNotActiveException extends Exception
{
    public function __construct()
    {
        parent::__construct('User is not active!', 403, null);
    }
}
