<?php


namespace App\Src\Mappers\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use Illuminate\Support\Collection;

class AvailabilitySearchModelMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (AvailabilitySearchModel $searchModel) {
            return self::toArray($searchModel);
        })->toArray();
    }

    public static function toArray(AvailabilitySearchModel $searchModel)
    {
        $employee = $searchModel->getEmployee();

        return [
            'id' => $employee->getId(),
            'name' => $employee->getFullName()
        ];
    }
}
