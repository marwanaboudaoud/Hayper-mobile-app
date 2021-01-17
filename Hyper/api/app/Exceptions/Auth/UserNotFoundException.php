<?php

namespace App\Exceptions\Auth;

use Exception;
use phpDocumentor\Reflection\Types\Null_;
use Throwable;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("User not found!", 404, null);
    }
}
