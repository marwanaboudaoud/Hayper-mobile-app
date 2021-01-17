<?php

namespace App\Exceptions\Notify;

use Exception;
use Throwable;

class EmailNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Email not set!', 409);
    }
}
