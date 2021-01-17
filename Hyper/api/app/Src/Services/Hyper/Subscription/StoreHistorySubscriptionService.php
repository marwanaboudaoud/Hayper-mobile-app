<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Src\Repositories\Hyper\Subscription\IHistorySubscriptionRepository;
use Carbon\Carbon;

class StoreHistorySubscriptionService implements IStoreHistorySubscriptionService
{
    /**
     * @var IHistorySubscriptionRepository
     */
    private $historySubscriptionRepository;

    public function __construct(
        IHistorySubscriptionRepository $historySubscriptionRepository
    ) {
        $this->historySubscriptionRepository = $historySubscriptionRepository;
    }

    public function store(HistorySubscriptionModel $subscriptionModel): HistorySubscriptionModel
    {
        $subscriptionModel->setActiveAt(Carbon::now())->setActive(true);

        return $this->historySubscriptionRepository->store($subscriptionModel);
    }
}
