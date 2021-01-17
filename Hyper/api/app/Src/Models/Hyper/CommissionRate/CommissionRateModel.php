<?php


namespace App\Src\Models\Hyper\CommissionRate;

class CommissionRateModel
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var integer
     */
    private $projectId;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CommissionRateModel
     */
    public function setId(?int $id): CommissionRateModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getRate(): ?float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     * @return CommissionRateModel
     */
    public function setRate(?float $rate): CommissionRateModel
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CommissionRateModel
     */
    public function setAmount(?float $amount): CommissionRateModel
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return CommissionRateModel
     */
    public function setProjectId(?int $projectId): CommissionRateModel
    {
        $this->projectId = $projectId;
        return $this;
    }

    /**
     * @return int
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return CommissionRateModel
     */
    public function setRoleId(?int $roleId): CommissionRateModel
    {
        $this->roleId = $roleId;

        return $this;
    }
}
