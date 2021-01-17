<?php


namespace App\Src\Mappers\Hyper\Role;

use App\Role;
use App\Src\Models\Hyper\Role\RoleModel;
use Illuminate\Database\Eloquent\Collection;

class RoleEloquentMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toModel($item);
        });
    }

    /**
     * @param Role $role
     * @return RoleModel
     */
    public static function toModel(Role $role)
    {
        return (new RoleModel())
            ->setId($role->id)
            ->setTitle($role->title)
            ->setCodeInNmbrs($role->code_in_nmbrs);
    }
}
