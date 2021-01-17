<?php


namespace App\Src\Repositories\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use Illuminate\Support\Collection;

interface IHistorySubscriptionRepository
{
    public function store(HistorySubscriptionModel $subscriptionModel): HistorySubscriptionModel;

    public function getBySubscriptionId(int $id): Collection;

    public function getByActiveSubscriptionId(int $id): Collection;

    public function update(HistorySubscriptionModel $historySubscriptionModel);
}
