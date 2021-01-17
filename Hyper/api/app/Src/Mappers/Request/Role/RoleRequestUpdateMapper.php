<?php


namespace App\Src\Mappers\Request\Role;

use App\Http\Requests\Role\RoleUpdateRequest;
use App\Src\Models\Hyper\Role\RoleModel;

class RoleRequestUpdateMapper
{
    /**
     * @param RoleUpdateRequest $roleUpdateRequest
     * @return RoleModel
     */
    public static function toModel(RoleUpdateRequest $roleUpdateRequest)
    {
        return (new RoleModel())
            ->setTitle($roleUpdateRequest->title)
            ->setCodeInNmbrs($roleUpdateRequest->code_in_nmbrs);
    }
}
