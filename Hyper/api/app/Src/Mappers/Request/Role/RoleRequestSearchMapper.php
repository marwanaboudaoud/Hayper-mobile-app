<?php


namespace App\Src\Mappers\Request\Role;

use App\Http\Requests\Pagination\RolePaginationRequest;
use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use App\Src\Models\Hyper\Role\RoleModel;

class RoleRequestSearchMapper
{
    public static function toRoleModel(RolePaginationRequest $rolePaginationRequest)
    {
        return (new PaginationRoleModel())
            ->setPage($rolePaginationRequest->page)
            ->setLimit($rolePaginationRequest->limit)
            ->setOrderBy($rolePaginationRequest->order_by)
            ->setDirection($rolePaginationRequest->direction)
            ->setRole(
                (new RoleModel())
                    ->setId((int)keyExistOrNull($rolePaginationRequest, 'search', 'id'))
                    ->setTitle(keyExistOrNull($rolePaginationRequest, 'search', 'title'))
                    ->setCodeInNmbrs(keyExistOrNull($rolePaginationRequest, 'search', 'code_in_nmbrs'))
            );
    }
}
