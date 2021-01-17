<?php

namespace App\Exceptions\Role;

use Exception;
use Throwable;

class RoleAlreadyExistsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Role already exists", 409);
    }
}
