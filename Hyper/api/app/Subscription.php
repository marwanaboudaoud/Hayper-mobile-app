<?php

namespace App;

use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeId($query, $id)
    {
        $id ? $query->where('subscriptions.id', 'LIKE', '%' . $id . '%') : null;
    }

    public function scopeSearchProject($query, $project)
    {
        $project ? $query->whereHas('project', function (Builder $query) use ($project) {
            $query->where('name', 'LIKE', '%' . $project . '%');
        }) : null;
    }

    public function scopeCode($query, $code)
    {
        $code ? $query->where('bw_code', 'LIKE', '%' . $code . '%') : null;
    }

    public function scopeDurationInMonths($query, $durationInMonths)
    {
        $durationInMonths ? $query->where('duration_in_months', 'LIKE', '%' . $durationInMonths . '%') : null;
    }

    public function scopeTitle($query, $title)
    {
        $title ? $query->where('title', 'LIKE', '%' . $title . '%') : null;
    }

    public function scopeOrder($query, $orderBy, $direction)
    {
        if ($orderBy && $direction) {
            $query->orderBy($orderBy, $direction);
        }
    }

    public function scopePagination($query, $limit, $page)
    {
        if ($limit && $page) {
            $query->limit($limit)
                ->offset($limit * ($page - 1));
        }
    }

    public function scopeSearch($query, SubscriptionPaginationModel $subscriptionPaginationModel)
    {
        $query->Id($subscriptionPaginationModel->getId())
            ->SearchProject($subscriptionPaginationModel->getProject())
            ->Code($subscriptionPaginationModel->getCode())
            ->DurationInMonths($subscriptionPaginationModel->getDurationInMonths())
            ->Title($subscriptionPaginationModel->getTitle())
            ->Order($subscriptionPaginationModel->getOrderBy(), $subscriptionPaginationModel->getDirection())
            ->Pagination($subscriptionPaginationModel->getLimit(), $subscriptionPaginationModel->getPage());
    }
}
