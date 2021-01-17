<?php


namespace App\Src\Repositories\Hyper\Subscription;

use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;

interface ISubscriptionRepository
{
    public function store(SubscriptionModel $subscriptionModel);

    public function find(?int $id): ?SubscriptionModel;

    public function update(SubscriptionModel $subscriptionModel);

    public function delete(int $id);

    public function get(SubscriptionPaginationModel $paginationModel);
}
