<?php


namespace App\Src\Services\Hyper\Subscription;

use App\Exceptions\Subscription\SubscriptionNotFoundException;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;

class DeleteSubscriptionService implements IDeleteSubscriptionService
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
     * @param int $id
     * @return b«oolean
     * @throws SubscriptionNotFoundException
     */
    public function delete(int $id)
    {
        $foundSubscription = $this->subscriptionRepository->find($id);

        if (!$foundSubscription) {
            throw new SubscriptionNotFoundException();
        }

        return $this->subscriptionRepository->delete($id);
    }
}
