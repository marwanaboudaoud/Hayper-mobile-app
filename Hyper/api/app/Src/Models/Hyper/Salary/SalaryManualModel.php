<?php


namespace App\Src\Models\Hyper\Salary;

use Carbon\Carbon;

class SalaryManualModel
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
    private $description;

    /**
     * @var float
     */
    private $price;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SalaryManualModel
     */
    public function setId(?int $id): SalaryManualModel
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
     * @return SalaryManualModel
     */
    public function setDate(?Carbon $date): SalaryManualModel
    {
        $this->date = $date;
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
     * @return SalaryManualModel
     */
    public function setDescription(?string $description): SalaryManualModel
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return SalaryManualModel
     */
    public function setPrice(?float $price): SalaryManualModel
    {
        $this->price = $price;
        return $this;
    }
}
