<?php

namespace App\Exceptions\HistorySubscription;

use Exception;
use Throwable;

class HistorySubscriptionNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('History subscription not found!', 404);
    }
}
