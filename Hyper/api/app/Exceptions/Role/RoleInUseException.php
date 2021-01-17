<?php

namespace App\Exceptions\Role;

use Exception;
use Throwable;

class RoleInUseException extends Exception
{
    public function __construct()
    {
        parent::__construct("Cannot delete Role! Role is currently in use", 400);
    }
}
