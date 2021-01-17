<?php


namespace App\Src\Models\Hyper\Project;

use App\CommissionRate;
use App\Src\Models\Hyper\Partner\PartnerModel;
use Illuminate\Support\Collection;

class ProjectModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var int
     */
    private $partnerId;

    /**
     * @var Collection
     */
    private $schedules;

    /**
     * @var PartnerModel
     */
    private $partner;

    /**
     * @var CommissionRate
     */
    private $commissionRate;

    /**
     * @var Collection
     */
    private $commissionRates;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param  int $id
     * @return ProjectModel
     */
    public function setId(?int $id): ProjectModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param  string $name
     * @return ProjectModel
     */
    public function setName(?string $name): ProjectModel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getSchedules(): ?Collection
    {
        return $this->schedules;
    }

    /**
     * @param  Collection $schedules
     * @return ProjectModel
     */
    public function setSchedules(?Collection $schedules): ProjectModel
    {
        $this->schedules = $schedules;

        return $this;
    }

    /**
     * @return int
     */
    public function getPartnerId(): ?int
    {
        return $this->partnerId;
    }

    /**
     * @param  int $partnerId
     * @return ProjectModel
     */
    public function setPartnerId(?int $partnerId): ProjectModel
    {
        $this->partnerId = $partnerId;
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
     * @return ProjectModel
     */
    public function setActive(?bool $active): ProjectModel
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return PartnerModel
     */
    public function getPartner(): ?PartnerModel
    {
        return $this->partner;
    }

    /**
     * @param PartnerModel $partner
     * @return ProjectModel
     */
    public function setPartner(?PartnerModel $partner): ProjectModel
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCommissionRates(): ?Collection
    {
        return $this->commissionRates ? $this->commissionRates : collect();
    }

    /**
     * @param Collection $commissionRates
     * @return ProjectModel
     */
    public function setCommissionRates(?Collection $commissionRates): ProjectModel
    {
        $this->commissionRates = $commissionRates;

        return $this;
    }
}
