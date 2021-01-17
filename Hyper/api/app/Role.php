<?php

namespace App;

use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function scopeId($query, $id)
    {
        $id ? $query->where('id', $id) : null;
    }

    public function scopeTitle($query, $title)
    {
        $title ? $query->where('title', 'LIKE', '%' . $title . '%') : null;
    }

    public function scopeCodeInNmbrs($query, $code_in_nmbrs)
    {
        $code_in_nmbrs ? $query->where('code_in_nmbrs', 'LIKE', '%' . $code_in_nmbrs . '%') : null;
    }

    /**
     * @param $query
     * @param PaginationRoleModel $paginationRoleModel
     * @return mixed
     */
    public function scopeSearch($query, PaginationRoleModel $paginationRoleModel)
    {
        $role = $paginationRoleModel->getRole();

        $query->Id(methodExistOrNull($role, 'getId'))
            ->Title(methodExistOrNull($role, 'getTitle'))
            ->CodeInNmbrs(methodExistOrNull($role, 'getCodeInNmbrs'));

        if ($paginationRoleModel->getOrderBy() && $paginationRoleModel->getDirection()) {
            $query->orderBy(
                $paginationRoleModel->getOrderBy(),
                $paginationRoleModel->getDirection()
            );
        }

        if ($paginationRoleModel->getLimit()) {
            $query->limit($paginationRoleModel->getLimit())
                ->offset(
                    $paginationRoleModel->getLimit() *
                    ($paginationRoleModel->getPage() - 1)
                );
        }
        return $query;
    }
}
