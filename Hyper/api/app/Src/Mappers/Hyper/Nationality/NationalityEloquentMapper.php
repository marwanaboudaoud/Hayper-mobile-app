<?php


namespace App\Src\Mappers\Hyper\Nationality;

use App\Nationality;
use App\Src\Models\Hyper\Nationality\NationalityModel;
use Illuminate\Support\Collection;

class NationalityEloquentMapper
{
    /**
     * @param Nationality $nationality
     * @return NationalityModel
     */
    public static function toModel(Nationality $nationality)
    {
        return (new NationalityModel())
            ->setId($nationality->id)
            ->setNationalityCode($nationality->nationality_code)
            ->setName($nationality->name);
    }

    public static function toCollection(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toModel($item);
        });
    }
}
