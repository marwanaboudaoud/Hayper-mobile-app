<?php


namespace App\Src\Mappers\Hyper\AvailabilityShift;

use App\AvailabilityShift;
use App\Src\Models\Hyper\AvailabilityShift\AvailabilityShiftModel;

class AvailabilityShiftEloquentModelMapper
{
    /**
     * @param AvailabilityShift $availabilityShift
     * @return AvailabilityShiftModel
     */
    public static function toModel(AvailabilityShift $availabilityShift)
    {
        return (new AvailabilityShiftModel())
            ->setId($availabilityShift->id)
            ->setName($availabilityShift->name);
    }
}
