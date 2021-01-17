<?php

namespace App\Exceptions\Subscription;

use Exception;
use Throwable;

class SubscriptionNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Subscription not found!', 404);
    }
}
