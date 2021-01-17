<?php


namespace App\Src\Models\Hyper\Contract;

class EmployeeContractActionModel
{
    /**
     * @var bool
     */
    private $extended;

    /**
     * @var int
     */
    private $employee_id;

    /**
     * @var int
     */
    private $old_contract_id;

    /**
     * @var int
     */
    private $new_contract_id;

    /**
     * @return bool
     */
    public function isExtended(): ?bool
    {
        return $this->extended;
    }

    /**
     * @param bool $extended
     * @return EmployeeContractActionModel
     */
    public function setExtended(?bool $extended): EmployeeContractActionModel
    {
        $this->extended = $extended;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmployeeId(): ?int
    {
        return $this->employee_id;
    }

    /**
     * @param int $employee_id
     * @return EmployeeContractActionModel
     */
    public function setEmployeeId(?int $employee_id): EmployeeContractActionModel
    {
        $this->employee_id = $employee_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getOldContractId(): ?int
    {
        return $this->old_contract_id;
    }

    /**
     * @param int $old_contract_id
     * @return EmployeeContractActionModel
     */
    public function setOldContractId(?int $old_contract_id): EmployeeContractActionModel
    {
        $this->old_contract_id = $old_contract_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNewContractId(): ?int
    {
        return $this->new_contract_id;
    }

    /**
     * @param int $new_contract_id
     * @return EmployeeContractActionModel
     */
    public function setNewContractId(?int $new_contract_id): EmployeeContractActionModel
    {
        $this->new_contract_id = $new_contract_id;
        return $this;
    }
}
