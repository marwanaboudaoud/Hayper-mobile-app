<?php


namespace App\Src\Mappers\Hyper\Country;

use App\Country;
use App\Src\Models\Hyper\Country\CountryModel;
use Illuminate\Support\Collection;

class CountryEloquentMapper
{
    /**
     * @param Country $country
     * @return CountryModel
     */
    public static function toModel(Country $country)
    {
        return (new CountryModel())
            ->setId($country->id)
            ->setCountry($country->country);
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
