<?php


namespace App\Src\Mappers\Hyper\User\Availability;

use App\Availability;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserAvailabilityEloquentMapper
{
    public static function toCollection(Collection $availability)
    {
        return $availability->map(function ($item) {
            return self::toModel($item);
        });
    }

    public static function toModel(Availability $availability)
    {
        return (new AvailabilityModel())
            ->setId($availability->id)
            ->setUserId($availability->user_id)
            ->setPresent(boolval($availability->is_present))
            ->setAvailabilityShiftId($availability->availability_shift_id)
            ->setDate(new Carbon($availability->date));
    }
}
