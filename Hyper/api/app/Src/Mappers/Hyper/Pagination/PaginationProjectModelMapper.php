<?php


namespace App\Src\Mappers\Hyper\Pagination;

use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use Illuminate\Support\Collection;

class PaginationProjectModelMapper implements IPaginationItemModelMapper, IPaginationCollectionModelMapper
{
    public static function toArray($model)
    {
        return ProjectModelMapper::toArray($model);
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
