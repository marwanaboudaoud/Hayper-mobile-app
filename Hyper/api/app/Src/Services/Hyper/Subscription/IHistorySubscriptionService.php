<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use Illuminate\Support\Collection;

interface IHistorySubscriptionService
{
    public function getBySubscriptionId(int $id): Collection;

    public function setInActive(
        HistorySubscriptionModel $historySubscriptionModel
    ): Collection;
}
