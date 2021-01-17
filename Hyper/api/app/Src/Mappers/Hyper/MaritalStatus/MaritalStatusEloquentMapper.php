<?php


namespace App\Src\Mappers\Hyper\MaritalStatus;

use App\MaritalStatus;
use App\Src\Models\MaritalStatus\MaritalStatusModel;
use Illuminate\Support\Collection;

class MaritalStatusEloquentMapper
{
    /**
     * @param MaritalStatus $maritalStatus
     * @return MaritalStatusModel
     */
    public static function toModel(MaritalStatus $maritalStatus)
    {
        return (new MaritalStatusModel())
            ->setId($maritalStatus->id)
            ->setName($maritalStatus->name);
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
