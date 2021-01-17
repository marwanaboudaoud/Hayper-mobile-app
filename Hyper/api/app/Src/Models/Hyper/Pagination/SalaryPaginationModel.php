<?php


namespace App\Src\Models\Hyper\Pagination;

use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;

class SalaryPaginationModel extends PaginationModel
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
     * @var string
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
     * @var string
     */
    private $price;

    /**
     * @var int
     */
    private $month;

    /**
     * @var int
     */
    private $year;

    /**
     * @var string
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
     * @return SalaryPaginationModel
     */
    public function setId(?int $id): SalaryPaginationModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeName(): ?string
    {
        $name = str_replace(' ', '', $this->employeeName);

        return $name;
    }

    /**
     * @param string $employeeName
     * @return SalaryPaginationModel
     */
    public function setEmployeeName(?string $employeeName): SalaryPaginationModel
    {
        $this->employeeName = $employeeName;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDate(): ?string
    {
        $date = dateDMYToYMD($this->date);

        return $date;
    }

    /**
     * @param Carbon $date
     * @return SalaryPaginationModel
     */
    public function setDate(?string $date): SalaryPaginationModel
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
     * @return SalaryPaginationModel
     */
    public function setHeading(?string $heading): SalaryPaginationModel
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
     * @return SalaryPaginationModel
     */
    public function setDescription(?string $description): SalaryPaginationModel
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return SalaryPaginationModel
     */
    public function setPrice(?string $price): SalaryPaginationModel
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getMonth(): ?int
    {
        return $this->month;
    }

    /**
     * @param int $month
     * @return SalaryPaginationModel
     */
    public function setMonth(?int $month): SalaryPaginationModel
    {
        $this->month = $month;
        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return SalaryPaginationModel
     */
    public function setYear(?int $year): SalaryPaginationModel
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalary(): ?string
    {
        return $this->salary;
    }

    /**
     * @param string $salary
     * @return SalaryPaginationModel
     */
    public function setSalary(?string $salary): SalaryPaginationModel
    {
        $this->salary = $salary;

        return $this;
    }

}
