<?php


namespace App\Src\Models\Hyper\Contract;

use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;

class EmployeeContractModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Carbon
     */
    private $start_date;

    /**
     * @var Carbon
     */
    private $end_date;

    /**
     * @var int
     */
    private $trial_per_day;

    /**
     * @var UserModel
     */
    private $user;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $document_number;

    /**
     * @var string
     */
    private $contractInMonths;

    /**
     * @var boolean
     */
    private $archived;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return EmployeeContractModel
     */
    public function setId(?int $id): EmployeeContractModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): ?Carbon
    {
        return $this->start_date;
    }

    /**
     * @param Carbon $start_date
     * @return EmployeeContractModel
     */
    public function setStartDate(?Carbon $start_date): EmployeeContractModel
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): ?Carbon
    {
        return $this->end_date;
    }

    /**
     * @param Carbon $end_date
     * @return EmployeeContractModel
     */
    public function setEndDate(?Carbon $end_date): EmployeeContractModel
    {
        $this->end_date = $end_date;
        return $this;
    }

    /**
     * @return int
     */
    public function getTrialPerDay(): ?int
    {
        return $this->trial_per_day;
    }

    /**
     * @param int $trial_per_day
     * @return EmployeeContractModel
     */
    public function setTrialPerDay(?int $trial_per_day): EmployeeContractModel
    {
        $this->trial_per_day = $trial_per_day;
        return $this;
    }

    /**
     * @return UserModel
     */
    public function getUser(): ?UserModel
    {
        return $this->user;
    }

    /**
     * @param UserModel $user
     * @return EmployeeContractModel
     */
    public function setUser(?UserModel $user): EmployeeContractModel
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentNumber(): ?string
    {
        return $this->document_number;
    }

    /**
     * @param string $document_number
     * @return EmployeeContractModel
     */
    public function setDocumentNumber(?string $document_number): EmployeeContractModel
    {
        $this->document_number = $document_number;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return EmployeeContractModel
     */
    public function setUserId(?int $userId): EmployeeContractModel
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $contractInMonths
     * @return $this
     */
    public function setContractInMonths(?string $contractInMonths)
    {
        $this->contractInMonths = $contractInMonths;

        return $this;
    }

    /**
     * @return string
     */
    public function getContractInMonths()
    {
        return $this->contractInMonths;
    }

    /**
     * @return bool
     */
    public function isArchived(): ?bool
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     * @return EmployeeContractModel
     */
    public function setArchived(?bool $archived): EmployeeContractModel
    {
        $this->archived = $archived;
        return $this;
    }
}
