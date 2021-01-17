<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Repositories\Hyper\Subscription\IHistorySubscriptionRepository;
use Carbon\Carbon;

class UpdateHistorySubscriptionService implements IUpdateHistorySubscriptionService
{
    /**
     * @var IHistorySubscriptionRepository
     */
    protected $subscriptionRepository;

    public function __construct(IHistorySubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function update(HistorySubscriptionModel $historySubscriptionModel)
    {
        $historySubscriptionModel->setActiveAt(Carbon::now()->addDay());

        return $this->subscriptionRepository->update($historySubscriptionModel);
    }
}
