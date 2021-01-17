<?php


namespace App\Src\Mappers\Hyper\Availability;

use App\Availability;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AvailabilityEloquentModelMapper
{
    public static function toModel(Availability $availability)
    {
        return (new AvailabilityModel())
            ->setId($availability->id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $availability->date)
            )
            ->setUserId($availability->user_id)
            ->setPresent(
                boolval($availability->is_present)
            )
            ->setAvailabilityShiftId($availability->availability_shift_id);
    }

    /**
     * @param Availability $availability
     * @return AvailabilitySearchModel
     */
    public static function toAvailabilitySearchModel(Availability $availability)
    {
        return (new AvailabilitySearchModel())
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $availability->date)
            )
            ->setEmployee(
                UserEloquentMapper::toUserModel($availability->user)
            );
    }

    public static function toAvailabilitySearchModelCollection(Collection $availabilities)
    {
        return $availabilities->map(function (Availability $item) {
            return self::toAvailabilitySearchModel($item);
        });
    }

    public static function toCollectionModel(Collection $availabilities)
    {
        return $availabilities->map(function (Availability $item) {
            return self::toAvailabilitySearchModel($item);
        });
    }
}
