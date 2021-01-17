<?php


namespace App\Src\Services\Hyper\Role;

use App\Src\Models\Hyper\Role\RoleModel;

interface IRoleUpdateService
{
    /**
     * @param int $id
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function update(int $id, RoleModel $roleModel);
}
