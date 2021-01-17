<?php


namespace App\Src\Mappers\Hyper\Pagination;

use App\Src\Mappers\Hyper\Subscription\SubscriptionModelMapper;
use Illuminate\Support\Collection;

class PaginationSubscriptionModelMapper implements IPaginationItemModelMapper, IPaginationCollectionModelMapper
{

    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toArray($item);
        })->toArray();
    }

    public static function toArray($model)
    {
        return SubscriptionModelMapper::toArray($model);
    }
}
