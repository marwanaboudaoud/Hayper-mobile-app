<?php

namespace App\Exceptions\Contract;

use Exception;
use Throwable;

class ContractNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Contract has not been found!', 404);
    }
}
