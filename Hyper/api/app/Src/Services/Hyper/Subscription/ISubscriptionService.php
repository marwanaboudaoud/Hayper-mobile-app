<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;
use Illuminate\Support\Collection;

interface ISubscriptionService
{
    /**
     * @param SubscriptionPaginationModel $paginationModel
     * @return Collection
     */
    public function get(SubscriptionPaginationModel $paginationModel): SubscriptionPaginationModel;

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);
}
