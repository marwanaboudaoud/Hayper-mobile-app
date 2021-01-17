<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;

interface IStoreHistorySubscriptionService
{
    public function store(HistorySubscriptionModel $subscriptionModel): HistorySubscriptionModel;
}
