<?php


namespace App\Src\Mappers\Request\Schedule;

use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Schedule\ScheduleUpdateRequest;
use App\Schedule;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;

class ScheduleRequestUpdateMapper
{
    public static function toModel(ScheduleUpdateRequest $item)
    {
        return (new ScheduleModel())
            ->setAvailabilityShiftId($item->availability_shift_id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $item->date)
            )
            ->setName($item->name)
            ->setAddress($item->address)
            ->setPostcode($item->postcode)
            ->setCity($item->city)
            ->setProjectId($item->project_id)
            ->setEmployees(
                ScheduleEmployeeRequestStoreMapper::toCollectionModel(
                    collect($item->employees)
                )
            )
            ->setDriver(
                ScheduleDriverRequestStoreMapper::toModel($item->driver)
            );
    }
}
