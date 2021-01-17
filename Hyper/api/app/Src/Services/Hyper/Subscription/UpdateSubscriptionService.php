<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Exceptions\Subscription\SubscriptionNotFoundException;
use App\Src\Mappers\Hyper\Subscription\SubscriptionModelMapper;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use App\Src\Services\Hyper\Project\IProjectService;

class UpdateSubscriptionService implements IUpdateSubscriptionService
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
     * @var IHistorySubscriptionService
     */
    private $historySubscriptionService;

    /**
     * @var IStoreHistorySubscriptionService
     */
    private $storeHistorySubscriptionService;

    public function __construct(
        ISubscriptionRepository $subscriptionRepository,
        IProjectService $projectService,
        IHistorySubscriptionService $historySubscriptionService,
        IStoreHistorySubscriptionService $storeHistorySubscriptionService
    ) {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->projectService = $projectService;
        $this->historySubscriptionService = $historySubscriptionService;
        $this->storeHistorySubscriptionService = $storeHistorySubscriptionService;
    }

    /**
     * @param SubscriptionModel $subscriptionModel
     * @throws SubscriptionNotFoundException
     */
    public function update(SubscriptionModel $subscriptionModel)
    {
        $foundSubscription = $this->subscriptionRepository->find($subscriptionModel->getId());

        if (!$foundSubscription) {
            throw new SubscriptionNotFoundException();
        }

        $historySubscriptionModel = SubscriptionModelMapper::toHistorySubscriptionModel($subscriptionModel);

        $this->projectService->find($subscriptionModel->getProjectId());
        $this->historySubscriptionService->setInActive($historySubscriptionModel);
        $this->storeHistorySubscriptionService->store($historySubscriptionModel);

        return $this->subscriptionRepository->update($subscriptionModel);
    }
}
