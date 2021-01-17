<?php


namespace App\Src\Mappers\Hyper\Nationality;

use App\Src\Models\Hyper\Nationality\NationalityModel;
use Illuminate\Support\Collection;

class NationalityModelMapper
{
    /**
     * @param NationalityModel $nationalityModel
     * @return array
     */
    public static function toArray(NationalityModel $nationalityModel)
    {
        return [
            'id' => $nationalityModel->getId(),
            'nationality_code' => $nationalityModel->getNationalityCode(),
            'name' => $nationalityModel->getName()
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
