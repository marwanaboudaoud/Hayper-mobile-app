<?php


namespace App\Src\Models\Hyper\Pagination;

class PaginationContractModel extends PaginationModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $startDate;

    /**
     * @var string
     */
    private $endDate;

    /**
     * @var string
     */
    private $employeeName;

    /**
     * @var string
     */
    private $contractInMonths;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PaginationContractModel
     */
    public function setId(?string $id): PaginationContractModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): ?string
    {
        $startDate = $this->startDate;
        return dateDMYToYMD($startDate);
    }

    /**
     * @param string $startDate
     * @return PaginationContractModel
     */
    public function setStartDate(?string $startDate): PaginationContractModel
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): ?string
    {
        $endDate = $this->endDate;
        return dateDMYToYMD($endDate);
    }

    /**
     * @param string $endDate
     * @return PaginationContractModel
     */
    public function setEndDate(?string $endDate): PaginationContractModel
    {
        $this->endDate = $endDate;
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
     * @return PaginationContractModel
     */
    public function setEmployeeName(?string $employeeName): PaginationContractModel
    {
        $this->employeeName = $employeeName;
        return $this;
    }

    /**
     * @param string|null $contractInMonths
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
}
