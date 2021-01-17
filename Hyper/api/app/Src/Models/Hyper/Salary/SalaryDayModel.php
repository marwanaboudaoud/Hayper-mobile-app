<?php


namespace App\Src\Models\Hyper\Salary;

use App\Src\Models\Hyper\Partner\PartnerModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryDayModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var boolean
     */
    private $hasDriven;

    /**
     * @var SalaryTotalPerDayModel
     */
    private $sub_total_ex_bonus_day;

    /**
     * @var SalaryTotalPerDayModel
     */
    private $sub_total_bonus_day;

    /**
     * @var SalaryTotalPerDayModel
     */
    private $sub_total_incl_bonus_day;

    /**
     * @var Collection
     */
    private $rows = [];

    /**
     * @var boolean
     */
    private $isManual;

    /**
     * @var PartnerModel
     */
    private $partner;

    /**
     * @var int
     */
    private $salaryId;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SalaryDayModel
     */
    public function setId(?int $id): SalaryDayModel
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     * @return SalaryDayModel
     */
    public function setDate(?Carbon $date): SalaryDayModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasDriven(): bool
    {
        return $this->hasDriven;
    }

    /**
     * @param bool $hasDriven
     * @return SalaryDayModel
     */
    public function setHasDriven(?bool $hasDriven): SalaryDayModel
    {
        $this->hasDriven = $hasDriven;
        return $this;
    }

    /**
     * @return SalaryTotalPerDayModel
     */
    public function getSubTotalExBonusDay(): ?SalaryTotalPerDayModel
    {
        return $this->sub_total_ex_bonus_day;
    }

    /**
     * @param SalaryTotalPerDayModel $sub_total_ex_bonus_day
     * @return SalaryDayModel
     */
    public function setSubTotalExBonusDay(SalaryTotalPerDayModel $sub_total_ex_bonus_day): SalaryDayModel
    {
        $this->sub_total_ex_bonus_day = $sub_total_ex_bonus_day;
        return $this;
    }

    /**
     * @return SalaryTotalPerDayModel
     */
    public function getSubTotalBonusDay(): ?SalaryTotalPerDayModel
    {
        return $this->sub_total_bonus_day;
    }

    /**
     * @param SalaryTotalPerDayModel $sub_total_bonus_day
     * @return SalaryDayModel
     */
    public function setSubTotalBonusDay(SalaryTotalPerDayModel $sub_total_bonus_day): SalaryDayModel
    {
        $this->sub_total_bonus_day = $sub_total_bonus_day;
        return $this;
    }

    /**
     * @return SalaryTotalPerDayModel
     */
    public function getSubTotalInclBonusDay(): ?SalaryTotalPerDayModel
    {
        return $this->sub_total_incl_bonus_day;
    }

    /**
     * @param SalaryTotalPerDayModel $sub_total_incl_bonus_day
     * @return SalaryDayModel
     */
    public function setSubTotalInclBonusDay(SalaryTotalPerDayModel $sub_total_incl_bonus_day): SalaryDayModel
    {
        $this->sub_total_incl_bonus_day = $sub_total_incl_bonus_day;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getRows(): ?Collection
    {
        return $this->rows;
    }

    /**
     * @param Collection $rows
     * @return SalaryDayModel
     */
    public function setRows(?Collection $rows): SalaryDayModel
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @param bool|null $isManual
     * @return SalaryDayModel
     */
    public function setIsManual(?bool $isManual): SalaryDayModel
    {
        $this->isManual = $isManual;

        return $this;
    }

    /**
     * @return bool
     */
    public function isManual()
    {
        return $this->isManual;
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
     * @return SalaryDayModel
     */
    public function setPartner(?PartnerModel $partner): SalaryDayModel
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * @param int|null $salaryId
     * @return $this
     */
    public function setSalaryId(?int $salaryId)
    {
        $this->salaryId = $salaryId;

        return $this;
    }

    public function getSalaryId()
    {
        return $this->salaryId;
    }
}
