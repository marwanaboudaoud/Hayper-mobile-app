<?php


namespace App\Src\Mappers\Hyper\Country;

use App\Src\Models\Hyper\Country\CountryModel;
use Illuminate\Support\Collection;

class CountryModelMapper
{
    /**
     * @param CountryModel $countryModel
     * @return array
     */
    public static function toArray(CountryModel $countryModel)
    {
        return [
            'id' => $countryModel->getId(),
            'country' => $countryModel->getCountry()
        ];
    }

    /**
     * @param Collection $collection
     * @return array
     */
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toArray($item);
        })->toArray();
    }
}
