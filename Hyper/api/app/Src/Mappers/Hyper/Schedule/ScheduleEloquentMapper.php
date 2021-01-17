<?php


namespace App\Src\Mappers\Hyper\Schedule;

use App\Schedule;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ScheduleEloquentMapper
{
    /**
     * @param  Collection $collection
     * @return Collection
     */
    public static function toCollectionModel(Collection $collection)
    {
        if (!$collection) {
            return null;
        }

        return $collection->map(
            function ($item) {
                return self::toModel($item);
            }
        );
    }

    /**
     * @param  Schedule $schedule
     * @return ScheduleModel
     */
    public static function toModel(Schedule $schedule)
    {
        return (new ScheduleModel())
            ->setId($schedule->id)
            ->setName($schedule->name)
            ->setAddress($schedule->address)
            ->setPostcode($schedule->postcode)
            ->setCity($schedule->city)
            ->setProjectId($schedule->project_id)
            ->setAvailabilityShiftId($schedule->availability_shift_id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $schedule->date)
            )
            ->setEmployees(
                UserEloquentMapper::toCollectionUserModel(
                    $schedule->employeeSchedules
                )
            )
            ->setDriver(
                UserEloquentMapper::toUserModel($schedule->driver)
            );
    }
}
