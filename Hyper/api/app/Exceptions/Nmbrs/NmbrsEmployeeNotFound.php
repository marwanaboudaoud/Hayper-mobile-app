<?php

namespace App\Exceptions\Nmbrs;

use Exception;
use Throwable;

class NmbrsEmployeeNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct("No Employee in Nmbrs", 404);
    }
}
