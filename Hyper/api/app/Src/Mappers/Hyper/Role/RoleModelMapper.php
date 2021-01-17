<?php


namespace App\Src\Mappers\Hyper\Role;

use App\Role;
use App\Src\Models\Hyper\Role\RoleModel;

class RoleModelMapper
{
    /**
     * @param RoleModel $roleModel
     * @return array
     */
    public static function toArray(?RoleModel $roleModel)
    {
        return $roleModel ? [
            'id' => $roleModel->getId(),
            'title' => $roleModel->getTitle(),
            'code_in_nmbrs' => $roleModel->getCodeInNmbrs(),
        ] : [];
    }

    /**
     * @param RoleModel $roleModel
     * @return Role
     */
    public static function toEloquent(RoleModel $roleModel)
    {
        $role = new Role();
        $role->title = $roleModel->getTitle();
        $role->code_in_nmbrs = $roleModel->getCodeInNmbrs();

        return $role;
    }

    /**
     * @param RoleModel $orgModel
     * @param RoleModel $updateModel
     * @return Role
     */
    public static function toEloquentUpdateModel(RoleModel $orgModel, RoleModel $updateModel)
    {
        $role = new Role();
        $role->id = $orgModel->getId();
        $role->title = $updateModel->getTitle() ?? $orgModel->getTitle();
        $role->code_in_nmbrs = $orgModel->getCodeInNmbrs() ?? $updateModel->getCodeInNmbrs();

        return $role;
    }
}
