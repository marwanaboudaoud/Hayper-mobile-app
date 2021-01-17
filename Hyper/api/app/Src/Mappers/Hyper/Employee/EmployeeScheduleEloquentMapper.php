<?php


namespace App\Src\Mappers\Hyper\Employee;

use App\Schedule;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class EmployeeScheduleEloquentMapper
{
    public static function toCollection(Collection $schedule)
    {

        return $schedule->map(function ($item) {
            return self::toModel($item);
        });
    }

    public static function toModel(Schedule $schedule)
    {
        $project = ProjectEloquentMapper::toModel($schedule->project);
        return (new ScheduleModel())
            ->setId($schedule->id)
            ->setName($schedule->name)
            ->setAddress($schedule->address)
            ->setPostcode($schedule->postcode)
            ->setCity($schedule->city)
            ->setDate(new Carbon($schedule->date))
            ->setDriver(
                UserEloquentMapper::toUserModel($schedule->driver)
            )
            ->setAvailabilityShiftId($schedule->availability_shift_id)
            ->setPartner($project->getPartner());
    }
}
