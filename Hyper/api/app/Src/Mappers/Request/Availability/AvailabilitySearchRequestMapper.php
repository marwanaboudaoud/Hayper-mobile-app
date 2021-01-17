<?php


namespace App\Src\Mappers\Request\Availability;

use App\Http\Requests\Availability\AvailabilitySearchRequest;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use Carbon\Carbon;

class AvailabilitySearchRequestMapper
{
    public static function toModel(AvailabilitySearchRequest $request)
    {
        $carbon = Carbon::createFromFormat('Y-m-d', $request->date);

        return (new AvailabilitySearchModel())
            ->setDate(
                $carbon
            )
            ->setDriver($request->is_driver)
            ->setAvailabilityShiftIds(collect($request->availability_shift_id));
    }
}
