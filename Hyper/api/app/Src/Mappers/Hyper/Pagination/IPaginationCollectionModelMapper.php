<?php


namespace App\Src\Mappers\Hyper\Pagination;

use Illuminate\Support\Collection;

interface IPaginationCollectionModelMapper
{
    public static function toCollectionArray(Collection $collection);
}
