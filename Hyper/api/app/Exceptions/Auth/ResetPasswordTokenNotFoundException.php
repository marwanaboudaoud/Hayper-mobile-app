<?php

namespace App\Exceptions\Auth;

use Exception;
use phpDocumentor\Reflection\Types\Null_;
use Throwable;

class ResetPasswordTokenNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Reset password token not found!', 404, null);
    }
}
