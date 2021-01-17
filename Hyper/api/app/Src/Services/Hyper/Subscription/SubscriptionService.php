<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Exceptions\Subscription\SubscriptionNotFoundException;
use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use Illuminate\Support\Collection;

class SubscriptionService implements ISubscriptionService
{
    /**
     * @var ISubscriptionRepository
     */
    private $subscriptionRepository;

    public function __construct(ISubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /**
     * @param SubscriptionPaginationModel $paginationModel
     * @return SubscriptionPaginationModel
     */
    public function get(SubscriptionPaginationModel $paginationModel): SubscriptionPaginationModel
    {
        return $this->subscriptionRepository->get($paginationModel);
    }

    /**
     * @param int $id
     * @inheritDoc
     * @throws SubscriptionNotFoundException
     */
    public function findById(int $id)
    {
        $subscriptionFound = $this->subscriptionRepository->find($id);

        if (!$subscriptionFound) {
            throw new SubscriptionNotFoundException();
        }

        return $subscriptionFound;
    }
}
