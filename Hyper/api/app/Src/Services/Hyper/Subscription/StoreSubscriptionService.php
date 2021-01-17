<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Src\Mappers\Hyper\Subscription\SubscriptionEloquentModelMapper;
use App\Src\Mappers\Hyper\Subscription\SubscriptionModelMapper;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use App\Src\Services\Hyper\Project\IProjectService;
use Carbon\Carbon;

class StoreSubscriptionService implements IStoreSubscriptionService
{
    /**
     * @var ISubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * @var IProjectService
     */
    private $projectService;

    /**
     * @var IStoreHistorySubscriptionService
     */
    private $storeHistorySubscriptionService;

    public function __construct(
        ISubscriptionRepository $subscriptionRepository,
        IProjectService $projectService,
        IStoreHistorySubscriptionService $storeHistorySubscriptionService
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->projectService = $projectService;
        $this->storeHistorySubscriptionService = $storeHistorySubscriptionService;
    }

    /**
     * @param SubscriptionModel $subscriptionModel
     * @return SubscriptionModel
     */
    public function store(SubscriptionModel $subscriptionModel)
    {
        $this->projectService->find($subscriptionModel->getProjectId());

        $storedSubscription = $this->subscriptionRepository->store($subscriptionModel);

        $historySubscriptionModel = SubscriptionModelMapper::toHistorySubscriptionModel($storedSubscription);

        $this->storeHistorySubscriptionService->store($historySubscriptionModel);

        return $storedSubscription;
    }
}
