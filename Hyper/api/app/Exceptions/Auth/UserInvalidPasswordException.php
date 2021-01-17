<?php

namespace App\Exceptions\Auth;

use Exception;

class UserInvalidPasswordException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid password!", 404, null);
    }
}
