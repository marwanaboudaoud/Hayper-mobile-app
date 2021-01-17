<?php


namespace App\Src\Mappers\Hyper\Gender;

use App\Gender;
use App\Src\Models\Hyper\Gender\GenderModel;
use Illuminate\Support\Collection;

class GenderEloquentMapper
{
    /**
     * @param Gender $gender
     * @return GenderModel
     */
    public static function toModel(Gender $gender)
    {
        return (new GenderModel())
            ->setId($gender->id)
            ->setName($gender->name);
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toCollection(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toModel($item);
        });
    }
}
