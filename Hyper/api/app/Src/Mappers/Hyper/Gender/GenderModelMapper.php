<?php


namespace App\Src\Mappers\Hyper\Gender;

use App\Src\Models\Hyper\Gender\GenderModel;
use Illuminate\Support\Collection;

class GenderModelMapper
{
    /**
     * @param GenderModel $genderModel
     * @return array
     */
    public static function toArray(GenderModel $genderModel)
    {
        return [
            'id' => $genderModel->getId(),
            'name' => $genderModel->getName()
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
