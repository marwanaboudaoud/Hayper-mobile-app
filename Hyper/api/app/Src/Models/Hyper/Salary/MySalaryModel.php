<?php


namespace App\Src\Models\Hyper\Salary;

use Carbon\Carbon;

class MySalaryModel
{
    /**
     * @var Carbon
     */
    private $startDate;

    /**
     * @var Carbon
     */
    private $endDate;

    /**
     * @var string
     */
    private $apiToken;

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return $this->startDate;
    }

    /**
     * @param Carbon $startDate
     * @return MySalaryModel
     */
    public function setStartDate(Carbon $startDate): MySalaryModel
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getEndDate(): Carbon
    {
        return $this->endDate;
    }

    /**
     * @param Carbon $endDate
     * @return MySalaryModel
     */
    public function setEndDate(Carbon $endDate): MySalaryModel
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @param string $apiToken
     * @return MySalaryModel
     */
    public function setApiToken(string $apiToken): MySalaryModel
    {
        $this->apiToken = $apiToken;
        return $this;
    }
}
