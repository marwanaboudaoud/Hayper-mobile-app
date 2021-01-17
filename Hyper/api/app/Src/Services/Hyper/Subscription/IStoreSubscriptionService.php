<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\SubscriptionModel;

interface IStoreSubscriptionService
{
    public function store(SubscriptionModel $subscriptionModel);
}
