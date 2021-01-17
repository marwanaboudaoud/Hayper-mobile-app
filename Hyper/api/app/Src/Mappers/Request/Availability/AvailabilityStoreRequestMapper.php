<?php


namespace App\Src\Mappers\Request\Availability;

use App\Http\Requests\Availability\AvailabilityStoreRequest;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Carbon\Carbon;

class AvailabilityStoreRequestMapper
{
    public static function toModel(AvailabilityStoreRequest $request)
    {
        return (new AvailabilityModel())
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $request->date)
            )
            ->setPresent($request->is_present)
            ->setApiToken($request->header('api-key'))
            ->setAvailabilityShiftId($request->availability_shift_id);
    }
}
