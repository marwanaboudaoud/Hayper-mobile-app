<?php

namespace App\Exceptions\Contract;

use Exception;
use Throwable;

class ContractCannotExtendedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Contract cannot be extended!', 500);
    }
}
