<?php


namespace App\Src\Mappers\Request\Schedule;

use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequestStoreMapper
{
    public static function toCollectionModel(FormRequest $scheduleStoreRequest)
    {

        $items = $scheduleStoreRequest->items;

        if (!$items) {
            return null;
        }

        return collect($items)->map(
            function ($item) {
                return self::toModel($item);
            }
        );
    }

    protected static function toModel(array $item)
    {
        $item = json_decode(json_encode($item));

        return (new ScheduleModel())
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $item->date)
            )
            ->setName($item->name)
            ->setAddress($item->address)
            ->setPostcode($item->postcode)
            ->setCity($item->city)
            ->setEmployees(
                ScheduleEmployeeRequestStoreMapper::toCollectionModel(
                    collect($item->employees)
                )
            )
            ->setDriver(
                ScheduleDriverRequestStoreMapper::toModel($item->driver)
            )
            ->setProjectId($item->project_id)
            ->setAvailabilityShiftId($item->availability_shift_id);
    }
}
