<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;

interface IUpdateHistorySubscriptionService
{
    public function update(HistorySubscriptionModel $historySubscriptionModel);
}
