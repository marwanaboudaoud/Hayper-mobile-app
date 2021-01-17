<?php

namespace App\Exceptions\Role;

use Exception;
use Throwable;

class RoleNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Role does not exist", 409, null);
    }
}
