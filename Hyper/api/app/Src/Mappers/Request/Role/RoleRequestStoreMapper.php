<?php


namespace App\Src\Mappers\Request\Role;

use App\Http\Requests\Role\RoleStoreRequest;
use App\Src\Models\Hyper\Role\RoleModel;

class RoleRequestStoreMapper
{
    /**
     * @param RoleStoreRequest $roleStoreRequest
     * @return RoleModel
     */
    public static function toModel(RoleStoreRequest $roleStoreRequest)
    {
        return (new RoleModel())
            ->setTitle($roleStoreRequest->title)
            ->setCodeInNmbrs($roleStoreRequest->code_in_nmbrs);
    }
}
