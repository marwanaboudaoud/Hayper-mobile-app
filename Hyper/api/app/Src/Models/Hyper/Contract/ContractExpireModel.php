<?php


namespace App\Src\Models\Hyper\Contract;

use Carbon\Carbon;

class ContractExpireModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $employeeName;

    /**
     * @var int
     */
    private $contractInMonths;

    /**
     * @var Carbon
     */
    private $endDate;

    /**
     * @var int
     */
    private $tillEndDateInDays;

    /**
     * @var int
     */
    private $amountContracts;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ContractExpireModel
     */
    public function setId(?int $id): ContractExpireModel
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getEmployeeName(): ?string
    {
        return $this->employeeName;
    }

    /**
     * @param string $employeeName
     * @return ContractExpireModel
     */
    public function setEmployeeName(?string $employeeName): ContractExpireModel
    {
        $this->employeeName = $employeeName;
        return $this;
    }

    /**
     * @return int
     */
    public function getContractInMonths(): ?int
    {
        return $this->contractInMonths;
    }

    /**
     * @param int $contractInMonths
     * @return ContractExpireModel
     */
    public function setContractInMonths(?int $contractInMonths): ContractExpireModel
    {
        $this->contractInMonths = $contractInMonths;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): ?Carbon
    {
        return $this->endDate;
    }

    /**
     * @param Carbon $endDate
     * @return ContractExpireModel
     */
    public function setEndDate(?Carbon $endDate): ContractExpireModel
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getTillEndDateInDays(): ?int
    {
        return $this->tillEndDateInDays;
    }

    /**
     * @param int $tillEndDateInDays
     * @return ContractExpireModel
     */
    public function setTillEndDateInDays(?int $tillEndDateInDays): ContractExpireModel
    {
        $this->tillEndDateInDays = $tillEndDateInDays;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmountContracts(): ?int
    {
        return $this->amountContracts;
    }

    /**
     * @param int $amountContracts
     * @return ContractExpireModel
     */
    public function setAmountContracts(?int $amountContracts): ContractExpireModel
    {
        $this->amountContracts = $amountContracts;

        return $this;
    }
}
