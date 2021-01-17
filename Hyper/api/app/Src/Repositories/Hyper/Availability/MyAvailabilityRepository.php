<?php


namespace App\Src\Repositories\Hyper\Availability;

use App\Src\Mappers\Hyper\User\Availability\UserAvailabilityEloquentMapper;
use App\Src\Models\Hyper\Availability\MyAvailabilityModel;
use App\User;

class MyAvailabilityRepository implements IMyAvailabilityRepository
{
    public function get(MyAvailabilityModel $availabilityModel)
    {
        $employeeAvailability = User::with(['availabilities' => function ($query) use ($availabilityModel) {
            $query->date($availabilityModel);
        }])
            ->where('api_token', $availabilityModel->getToken())
            ->first();

        return UserAvailabilityEloquentMapper::toCollection($employeeAvailability->availabilities);
    }
}
