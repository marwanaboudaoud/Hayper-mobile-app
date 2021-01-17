<?php


namespace App\Src\Mappers\Request\Employee\Availability;

use App\Http\Requests\Employee\Availability\EmployeeAvailabilityRequest;
use App\Src\Models\Hyper\Availability\MyAvailabilityModel;
use Illuminate\Support\Carbon;

class EmployeeAvailabilityRequestMapper
{
    public static function toModel(EmployeeAvailabilityRequest $employeeAvailabilityRequest)
    {
        $start = Carbon::createFromFormat('Y-m-d', $employeeAvailabilityRequest->start_date);
        $end = Carbon::createFromFormat('Y-m-d', $employeeAvailabilityRequest->end_date);

        return (new MyAvailabilityModel())
            ->setStartDate($start)
            ->setEndDate($end)
            ->setToken($employeeAvailabilityRequest->header('api-key'));
    }
}
