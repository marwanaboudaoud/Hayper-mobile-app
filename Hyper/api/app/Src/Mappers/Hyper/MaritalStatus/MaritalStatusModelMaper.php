<?php


namespace App\Src\Mappers\Hyper\MaritalStatus;

use App\Src\Models\MaritalStatus\MaritalStatusModel;
use Illuminate\Support\Collection;

class MaritalStatusModelMaper
{
    /**
     * @param MaritalStatusModel $maritalStatusModel
     * @return array
     */
    public static function toArray(MaritalStatusModel $maritalStatusModel)
    {
        return [
            'id' => $maritalStatusModel->getId(),
            'name' => $maritalStatusModel->getName()
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
