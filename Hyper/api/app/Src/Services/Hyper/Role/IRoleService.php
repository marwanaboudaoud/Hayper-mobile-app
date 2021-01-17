<?php


namespace App\Src\Services\Hyper\Role;

use App\Src\Models\Hyper\Pagination\PaginationRoleModel;

interface IRoleService
{
    /**
     * @param PaginationRoleModel $paginationRoleModel
     * @return mixed
     */
    public function get(PaginationRoleModel $paginationRoleModel);

    /**
     * @param string $title
     * @return mixed
     */
    public function findByTitle(string $title);

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function getRoleWithRelation(int $id);
}
