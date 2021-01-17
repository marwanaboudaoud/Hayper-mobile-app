<?php


namespace App\Src\Repositories\Hyper\Subscription;

use App\HistorySubscription;
use App\Src\Mappers\Hyper\Subscription\HistorySubscriptionEloquentMapper;
use App\Src\Mappers\Hyper\Subscription\HistorySubscriptionModelMapper;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use Illuminate\Support\Collection;

class HistorySubscriptionRepository implements IHistorySubscriptionRepository
{
    /**
     * @param HistorySubscriptionModel $subscriptionModel
     * @return HistorySubscriptionModel
     */
    public function store(HistorySubscriptionModel $subscriptionModel): HistorySubscriptionModel
    {
        $model = HistorySubscriptionModelMapper::toEloquentModel($subscriptionModel);
        $model->save();

        return HistorySubscriptionEloquentMapper::toModel($model);
    }

    public function findBy(array $where): Collection
    {
        $results = HistorySubscription::where($where)->get();

        return HistorySubscriptionEloquentMapper::toCollectionModel($results);
    }

    public function getBySubscriptionId(int $id): Collection
    {
        return $this->findBy([
            'subscription_id' => $id
        ]);
    }

    public function getByActiveSubscriptionId(int $id): Collection
    {
        return $this->findBy([
            'is_active' => true,
            'subscription_id' => $id
        ]);
    }

    public function update(HistorySubscriptionModel $historySubscriptionModel)
    {
        $result = HistorySubscriptionModelMapper::toEloquentUpdateModel($historySubscriptionModel);
        $result->save();

        return $historySubscriptionModel;
    }
}
