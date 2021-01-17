<?php


namespace App\Src\Models\Hyper\Subscription;

use App\Src\Models\Hyper\Project\ProjectModel;
use Carbon\Carbon;

class SubscriptionModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var double
     */
    private $gross_amount;

    /**
     * @var int
     */
    private $durationInMonths;

    /**
     * @var Carbon
     */
    private $startingDate;

    /**
     * @var float
     */
    private $reward;

    /**
     * @var bool
     */
    private $bonusCalc;

    /**
     * @var string
     */
    private $bwCode;

    /**
     * @var int
     */
    private $projectId;

    /**
     * @var ProjectModel
     */
    private $project;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SubscriptionModel
     */
    public function setId(?int $id): SubscriptionModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return SubscriptionModel
     */
    public function setTitle(?string $title): SubscriptionModel
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return float
     */
    public function getGrossAmount(): ?float
    {
        return $this->gross_amount;
    }

    /**
     * @param float $gross_amount
     * @return SubscriptionModel
     */
    public function setGrossAmount(?float $gross_amount): SubscriptionModel
    {
        $this->gross_amount = $gross_amount;
        return $this;
    }



    /**
     * @return int
     */
    public function getDurationInMonths(): ?int
    {
        return $this->durationInMonths;
    }

    /**
     * @param int $durationInMonths
     * @return SubscriptionModel
     */
    public function setDurationInMonths(?int $durationInMonths): SubscriptionModel
    {
        $this->durationInMonths = $durationInMonths;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getStartingDate(): ?Carbon
    {
        return $this->startingDate;
    }

    /**
     * @param Carbon $startingDate
     * @return SubscriptionModel
     */
    public function setStartingDate(?Carbon $startingDate): SubscriptionModel
    {
        $this->startingDate = $startingDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getReward(): ?float
    {
        return $this->reward;
    }

    /**
     * @param float $reward
     * @return SubscriptionModel
     */
    public function setReward(?float $reward): SubscriptionModel
    {
        $this->reward = $reward;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBonusCalc(): ?bool
    {
        return $this->bonusCalc;
    }

    /**
     * @param bool $bonusCalc
     * @return SubscriptionModel
     */
    public function setBonusCalc(?bool $bonusCalc): SubscriptionModel
    {
        $this->bonusCalc = $bonusCalc;
        return $this;
    }

    /**
     * @return string
     */
    public function getBwCode(): ?string
    {
        return $this->bwCode;
    }

    /**
     * @param string $bwCode
     * @return SubscriptionModel
     */
    public function setBwCode(?string $bwCode): SubscriptionModel
    {
        $this->bwCode = $bwCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return SubscriptionModel
     */
    public function setProjectId(?int $projectId): SubscriptionModel
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @return ProjectModel
     */
    public function getProject(): ?ProjectModel
    {
        return $this->project;
    }

    /**
     * @param ProjectModel $project
     * @return SubscriptionModel
     */
    public function setProject(?ProjectModel $project): SubscriptionModel
    {
        $this->project = $project;

        return $this;
    }
}
