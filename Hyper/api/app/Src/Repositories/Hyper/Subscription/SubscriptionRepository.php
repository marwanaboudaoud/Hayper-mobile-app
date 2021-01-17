<?php


namespace App\Src\Repositories\Hyper\Subscription;

use App\Src\Mappers\Hyper\Subscription\SubscriptionEloquentModelMapper;
use App\Src\Mappers\Hyper\Subscription\SubscriptionModelMapper;
use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Subscription;
use Illuminate\Support\Collection;

class SubscriptionRepository implements ISubscriptionRepository
{
    /**
     * @param SubscriptionModel $subscriptionModel
     * @return SubscriptionModel
     */
    public function store(SubscriptionModel $subscriptionModel)
    {
        $eloquent = SubscriptionModelMapper::toEloquentModel($subscriptionModel);
        $eloquent->save();

        return SubscriptionEloquentModelMapper::toModel($eloquent);
    }

    /**
     * @param int|null $id
     * @return SubscriptionModel
     */
    public function find(?int $id): ?SubscriptionModel
    {
        $eloquent = Subscription::find($id);

        if (!$eloquent) {
            return null;
        }

        return SubscriptionEloquentModelMapper::toModel($eloquent);
    }

    /**
     * @param SubscriptionModel $subscriptionModel
     * @return SubscriptionModel|bool
     */
    public function update(SubscriptionModel $subscriptionModel)
    {
        $oldModel = $this->find($subscriptionModel->getId());

        if (!$oldModel) {
            return false;
        }

        $model = SubscriptionModelMapper::toEloquentUpdateModel($oldModel, $subscriptionModel);
        $model->save();

        return SubscriptionEloquentModelMapper::toModel($model);
    }

    public function delete(int $id)
    {
        $foundSubscription = Subscription::find($id);

        if (!$foundSubscription) {
            return null;
        }

        $foundSubscription->delete();

        return true;
    }

    /**
     * @param SubscriptionPaginationModel $paginationModel
     * @return \App\Src\Models\Hyper\Pagination\PaginationModel
     */
    public function get(SubscriptionPaginationModel $paginationModel)
    {
        $limit = $paginationModel->getLimit();
        $subscriptionsQ = Subscription::with('project')
            ->select('subscriptions.*', 'projects.name AS project_name')
            ->join('projects', 'subscriptions.project_id', '=', 'projects.id');

        $subscriptions = $subscriptionsQ->Search($paginationModel)->get();
        $count = $subscriptionsQ->Search($paginationModel->setLimit(null))->count();
        $subscriptions = SubscriptionEloquentModelMapper::toCollectionModel($subscriptions);

        return $paginationModel->setItems($subscriptions)
            ->setTotalItems($count)
            ->setLimit($limit);
    }
}
