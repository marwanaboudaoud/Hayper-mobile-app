<?php


namespace App\Src\Mappers\Hyper\Pagination;

use App\Src\Mappers\Hyper\User\UserModelMapper;
use Illuminate\Support\Collection;

class PaginationUserModelMapper implements IPaginationItemModelMapper, IPaginationCollectionModelMapper
{
    public static function toArray($model)
    {
        return UserModelMapper::toArray($model);
    }

    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toArray($item);
            }
        );
    }
}
