<?php


namespace App\Src\Repositories\Hyper\Role;

use App\Role;
use App\Src\Mappers\Hyper\Role\RoleEloquentMapper;
use App\Src\Mappers\Hyper\Role\RoleModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use App\Src\Models\Hyper\Role\RoleModel;

class RoleRepository implements IRoleRepository
{

    /**
     * @param PaginationRoleModel $paginationRoleModel
     * @return PaginationModel
     */
    public function get(PaginationRoleModel $paginationRoleModel)
    {
        $limit = $paginationRoleModel->getLimit();

        $roleEloquent = Role::Search($paginationRoleModel)->get();
        $roleCount = Role::Search($paginationRoleModel->setLimit(null))->count();

        $models = RoleEloquentMapper::toCollectionModel($roleEloquent);

        return $paginationRoleModel->setLimit($limit)
            ->setItems($models)
            ->setTotalItems($roleCount);
    }

    /**
     * @param string $attr
     * @param string $arg
     * @param bool $eloquentModel
     * @return \App\Src\Models\Hyper\Role\RoleModel|mixed|null
     */
    public function findBy(string $attr, string $arg, bool $eloquentModel = false)
    {
        $role = Role::where($attr, $arg)->first();

        if (!$role) {
            return null;
        }

        if ($eloquentModel) {
            return $role;
        }

        return RoleEloquentMapper::toModel($role);
    }


    /**
     * @param int $id
     * @return \App\Src\Models\Hyper\Role\RoleModel|mixed|null
     */
    public function findById(int $id)
    {
        return $this->findBy('id', $id);
    }

    /**
     * @param RoleModel $roleModel
     * @return RoleModel
     */
    public function store(RoleModel $roleModel)
    {
        $role = RoleModelMapper::toEloquent($roleModel);
        $role->save();
        return RoleEloquentMapper::toModel($role);
    }

    /**
     * @param string $title
     * @return RoleModel|mixed|null
     */
    public function findByTitle(string $title)
    {
        return $this->findBy('title', $title);
    }

    /**
     * @param int $id
     * @param RoleModel $roleModel
     * @return mixed|void
     */
    public function update(int $id, RoleModel $roleModel)
    {
        $foundRole = $this->findById($id);
        $updateModel = RoleModelMapper::toEloquentUpdateModel($foundRole, $roleModel);
        $updateModel->exists = true;
        $updateModel->save();

        return RoleEloquentMapper::toModel($updateModel);
    }

    /**
     * @param $value
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getRoleWithRelation(int $id)
    {
        return Role::query()
            ->orWhere('id', '=', $id)
            ->with('users')
            ->first();
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $role = Role::query()
            ->where('id', $id)->first();
        return $role->delete();
    }
}
