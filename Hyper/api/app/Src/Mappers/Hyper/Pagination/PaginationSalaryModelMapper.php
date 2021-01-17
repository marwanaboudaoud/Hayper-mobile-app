<?php


namespace App\Src\Mappers\Hyper\Pagination;

use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use Illuminate\Support\Collection;

class PaginationSalaryModelMapper implements IPaginationItemModelMapper, IPaginationCollectionModelMapper
{

    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toArray($item);
            }
        );
    }

    public static function toArray($model)
    {
        return SalaryModelMapper::toArray($model);
    }
}
