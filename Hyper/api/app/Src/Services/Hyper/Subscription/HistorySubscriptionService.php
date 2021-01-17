<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Exceptions\HistorySubscription\HistorySubscriptionNotFound;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Repositories\Hyper\Subscription\IHistorySubscriptionRepository;
use Illuminate\Support\Collection;

class HistorySubscriptionService implements IHistorySubscriptionService
{
    /**
     * @var IHistorySubscriptionRepository
     */
    private $historySubscriptionRepository;

    /**
     * @var IUpdateHistorySubscriptionService
     */
    private $updateHistorySubscriptionService;

    public function __construct(
        IHistorySubscriptionRepository $historySubscriptionRepository,
        IUpdateHistorySubscriptionService $updateHistorySubscriptionService
    ) {
        $this->historySubscriptionRepository = $historySubscriptionRepository;
        $this->updateHistorySubscriptionService = $updateHistorySubscriptionService;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getBySubscriptionId(int $id): Collection
    {
        return $this->historySubscriptionRepository->getByActiveSubscriptionId($id);
    }

    /**
     * @param HistorySubscriptionModel $historySubscriptionModel
     * @return Collection
     */
    public function setInActive(HistorySubscriptionModel $historySubscriptionModel): Collection
    {
        $result = $this->getBySubscriptionId($historySubscriptionModel->getSubscriptionId());

        $result = $result->each(function (HistorySubscriptionModel $item) {
            $item->setActive(false);

            $this->updateHistorySubscriptionService->update($item);
        });

        return $result;
    }
}
