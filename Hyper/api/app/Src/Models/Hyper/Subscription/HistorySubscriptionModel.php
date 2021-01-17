<?php


namespace App\Src\Models\Hyper\Subscription;

use Carbon\Carbon;

class HistorySubscriptionModel extends SubscriptionModel
{
    /**
     * @var int
     */
    private $subscriptionId;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var Carbon
     */
    private $activeAt;

    /**
     * @return int
     */
    public function getSubscriptionId(): ?int
    {
        return $this->subscriptionId;
    }

    /**
     * @param int $subscriptionId
     * @return HistorySubscriptionModel
     */
    public function setSubscriptionId(?int $subscriptionId): HistorySubscriptionModel
    {
        $this->subscriptionId = $subscriptionId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return HistorySubscriptionModel
     */
    public function setActive(?bool $active): HistorySubscriptionModel
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getActiveAt(): ?Carbon
    {
        return $this->activeAt;
    }

    /**
     * @param Carbon $activeAt
     * @return HistorySubscriptionModel
     */
    public function setActiveAt(?Carbon $activeAt): HistorySubscriptionModel
    {
        $this->activeAt = $activeAt;
        return $this;
    }
}
