<?php

namespace App\Exceptions\Auth;

use Exception;
use Throwable;

class ResetPasswordTokenAlreadyUsedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Reset token already used!', 409);
    }
}
