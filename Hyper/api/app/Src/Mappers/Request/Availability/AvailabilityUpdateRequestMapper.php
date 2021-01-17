<?php


namespace App\Src\Mappers\Request\Availability;

use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Carbon\Carbon;

class AvailabilityUpdateRequestMapper
{
    /**
     * @param AvailabilityUpdateRequest $availabilityUpdateRequest
     * @return AvailabilityModel
     */
    public static function toModel(AvailabilityUpdateRequest $availabilityUpdateRequest)
    {
        return (new AvailabilityModel())
            ->setApiToken($availabilityUpdateRequest->header('api-key'))
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $availabilityUpdateRequest->date)
            )
            ->setPresent(boolval($availabilityUpdateRequest->is_present))
            ->setAvailabilityShiftId($availabilityUpdateRequest->availability_shift_id);
    }
}
