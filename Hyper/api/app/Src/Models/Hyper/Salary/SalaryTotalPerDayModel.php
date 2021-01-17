<?php


namespace App\Src\Models\Hyper\Salary;

use Carbon\Carbon;

class SalaryTotalPerDayModel
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
     * @var float
     */
    private $salary;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SalaryTotalPerDayModel
     */
    public function setId(?int $id): SalaryTotalPerDayModel
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
     * @return SalaryTotalPerDayModel
     */
    public function setDate(?Carbon $date): SalaryTotalPerDayModel
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalary(): ?float
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     * @return SalaryTotalPerDayModel
     */
    public function setSalary(?float $salary): SalaryTotalPerDayModel
    {
        $this->salary = $salary;
        return $this;
    }
}
