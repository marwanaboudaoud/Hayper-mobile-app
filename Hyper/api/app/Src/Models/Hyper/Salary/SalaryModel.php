<?php


namespace App\Src\Models\Hyper\Salary;

use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryModel
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
     * @var string
     */
    private $heading;

    /**
     * @var string
     */
    private $description;

    /**
     * @var UserModel
     */
    private $employee;

    /**
     * @var float
     */
    private $totalSalary;

    /**
     * @var Collection
     */
    private $salaryDays = [];

    /**
     * @var Collection
     */
    private $salaryManual = [];

    /**
     * @var boolean
     */
    private $closed;

    /**
     * @var int
     */
    private $user_id;


    /**
     * @param $id
     * @return SalaryModel
     */
    public function setId($id): SalaryModel
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return SalaryModel
     */
    public function setDate(?Carbon $date): SalaryModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeading(): ?string
    {
        return $this->heading;
    }

    /**
     * @param string $heading
     * @return SalaryModel
     */
    public function setHeading(?string $heading): SalaryModel
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return SalaryModel
     */
    public function setDescription(?string $description): SalaryModel
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalSalary(): ?float
    {
        return $this->totalSalary;
    }

    /**
     * @param float $totalSalary
     * @return SalaryModel
     */
    public function setTotalSalary(?float $totalSalary): SalaryModel
    {
        $this->totalSalary = $totalSalary;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSalaryDays(): ?Collection
    {
        return $this->salaryDays;
    }

    /**
     * @param Collection $salaryDays
     * @return SalaryModel
     */
    public function setSalaryDays(?Collection $salaryDays): SalaryModel
    {
        $this->salaryDays = $salaryDays;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getSalaryManual(): ?Collection
    {
        return $this->salaryManual;
    }

    /**
     * @param Collection $salaryManual
     * @return SalaryModel
     */
    public function setSalaryManual(?Collection $salaryManual): SalaryModel
    {
        $this->salaryManual = $salaryManual;

        return $this;
    }

    /**
     * @return UserModel
     */
    public function getEmployee(): ?UserModel
    {
        return $this->employee;
    }

    /**
     * @param UserModel $employee
     * @return SalaryModel
     */
    public function setEmployee(?UserModel $employee): SalaryModel
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return bool
     */
    public function isClosed(): ?bool
    {
        return $this->closed;
    }

    /**
     * @param bool $closed
     * @return SalaryModel
     */
    public function setClosed(?bool $closed): SalaryModel
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     * @return SalaryModel
     */
    public function setUserId(?int $user_id): SalaryModel
    {
        $this->user_id = $user_id;
        return $this;
    }
}
