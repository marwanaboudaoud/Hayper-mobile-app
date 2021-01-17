<?php


namespace App\Src\Services\Hyper\Role;

use App\Src\Models\Hyper\Role\RoleModel;

interface IRoleStoreService
{
    /**
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function store(RoleModel $roleModel);
}
