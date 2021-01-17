<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\SubscriptionModel;

interface IUpdateSubscriptionService
{
    public function update(SubscriptionModel $subscriptionModel);
}
