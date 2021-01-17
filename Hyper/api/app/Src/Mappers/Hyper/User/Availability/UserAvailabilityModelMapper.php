<?php


namespace App\Src\Mappers\Hyper\User\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Illuminate\Support\Collection;

class UserAvailabilityModelMapper
{
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

    public static function toArray(AvailabilityModel $availabilityModel)
    {
        return [
            'id' => $availabilityModel->getId(),
            'user_id' => $availabilityModel->getUserId(),
            'present' => $availabilityModel->isPresent(),
            'date' => $availabilityModel->getDate()->toDateString(),
            'availability_shift_id' => $availabilityModel->getAvailabilityShiftId()
        ];
    }
}
