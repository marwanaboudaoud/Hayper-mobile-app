<?php

namespace App;

use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function employees()
    {
        return $this->belongsToMany(
            User::class,
            'works_on_project'
        );
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function commissionRates()
    {
        return $this->hasMany(CommissionRate::class);
    }

    /**
     * @param $query
     * @param $id
     */
    public function scopeId($query, $id)
    {
        $id ? $query->where('id', $id) : null;
    }

    /**
     * @param  $query
     * @param  $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        $name ? $query->where('name', 'LIKE', '%' . $name . '%') : null;
    }

    /**
     * @param $query
     * @param $is_active
     */
    public function scopeIsActive($query, $is_active)
    {
        $is_active ? $query->where('is_active', 'LIKE', '%' . $is_active . '%') : null;
    }


    /**
     * @param $query
     * @param $partnerId
     */
    public function scopePartnerId($query, $partnerId)
    {
        $partnerId ? $this->partner() : null;
    }

    public function scopeSearch($query, PaginationProjectModel $paginationProjectModel)
    {
        $projectModel = $paginationProjectModel->getProject();

        $query =  $query->Id($projectModel->getId())
            ->Name($projectModel->getName())
            ->IsActive($projectModel->isActive())
            ->PartnerId($projectModel->getPartnerId())
            ->orderBy(
                $paginationProjectModel->getOrderBy(),
                $paginationProjectModel->getDirection()
            );

        if ($paginationProjectModel->getLimit()) {
            $query->limit($paginationProjectModel->getLimit())
                ->offset(
                    $paginationProjectModel->getLimit() *
                    ($paginationProjectModel->getPage() - 1)
                );
        }

        return $query;
    }
}
