<?php


namespace App\Src\Models\Hyper\Salary;

class SalaryRowModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $underlineDescription;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var float
     */
    private $price;

    /**
     * @var bool
     */
    private $bonus;

    /**
     * @var int
     */
    private $salaryDayId;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
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
     * @return SalaryRowModel
     */
    public function setDescription(?string $description): SalaryRowModel
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnderlineDescription(): ?string
    {
        return $this->underlineDescription;
    }

    /**
     * @param string $underlineDescription
     * @return SalaryRowModel
     */
    public function setUnderlineDescription(?string $underlineDescription): SalaryRowModel
    {
        $this->underlineDescription = $underlineDescription;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return SalaryRowModel
     */
    public function setAmount(?int $amount): SalaryRowModel
    {
        $this->amount = $amount;
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
     * @return SalaryRowModel
     */
    public function setPrice(?float $price): SalaryRowModel
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBonus(): ?bool
    {
        return $this->bonus;
    }

    /**
     * @param bool $bonus
     * @return SalaryRowModel
     */
    public function setBonus(?bool $bonus): SalaryRowModel
    {
        $this->bonus = $bonus;
        return $this;
    }

    /**
     * @return int
     */
    public function getSalaryDayId(): ?int
    {
        return $this->salaryDayId;
    }

    /**
     * @param int $salaryDayId
     * @return SalaryRowModel
     */
    public function setSalaryDayId(?int $salaryDayId): SalaryRowModel
    {
        $this->salaryDayId = $salaryDayId;
        return $this;
    }
}
