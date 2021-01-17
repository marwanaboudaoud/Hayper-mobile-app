<?php


namespace App\Src\Repositories\Hyper\Role;

use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use App\Src\Models\Hyper\Role\RoleModel;

interface IRoleRepository
{
    /**
     * @param PaginationRoleModel $paginationRoleModel
     * @return mixed
     */
    public function get(PaginationRoleModel $paginationRoleModel);

    /**
     * @param string $attr
     * @param string $arg
     * @param bool $eloquentModel
     * @return mixed
     */
    public function findBy(string $attr, string $arg, bool $eloquentModel = false);

    /**
     * @param int $id
     * @return RoleModel
     */
    public function findById(int $id);

    /**
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function store(RoleModel $roleModel);

    /**
     * @param string $title
     * @return mixed
     */
    public function findByTitle(string $title);

    /**
     * @param int $id
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function update(int $id, RoleModel $roleModel);

    /**
     * @param int $id
     * @return mixed
     */
    public function getRoleWithRelation(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
