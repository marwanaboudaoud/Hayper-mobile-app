<?php


namespace App\Src\Models\Hyper\Pagination;

use App\Src\Models\Hyper\Role\RoleModel;

class PaginationRoleModel extends PaginationModel
{
    /**
     * @var RoleModel
     */
    private $role;

    /**
     * @return RoleModel
     */
    public function getRole(): ?RoleModel
    {
        return $this->role;
    }

    /**
     * @param RoleModel $role
     * @return PaginationRoleModel
     */
    public function setRole(?RoleModel $role): PaginationRoleModel
    {
        $this->role = $role;
        return $this;
    }
}
