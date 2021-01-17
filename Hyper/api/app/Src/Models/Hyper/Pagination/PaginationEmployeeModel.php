<?php


namespace App\Src\Models\Hyper\Pagination;

use App\Src\Models\Hyper\User\UserModel;

class PaginationEmployeeModel extends PaginationModel
{
    /**
     * @var UserModel
     */
    private $employee;

    /**
     * @return UserModel
     */
    public function getEmployee(): ?UserModel
    {
        return $this->employee;
    }

    /**
     * @param UserModel $employee
     * @return PaginationEmployeeModel
     */
    public function setEmployee(?UserModel $employee): PaginationEmployeeModel
    {
        $this->employee = $employee;
        return $this;
    }
}
