<?php

namespace App\Exceptions\Notify;

use Exception;

class FriendModelNotSetException extends Exception
{
    public function __construct()
    {
        parent::__construct('Friend not set!', 409);
    }
}
