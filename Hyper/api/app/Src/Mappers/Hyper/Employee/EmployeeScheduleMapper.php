<?php


namespace App\Src\Mappers\Hyper\Employee;

use App\Src\Mappers\Hyper\Partner\PartnerModelMapper;
use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Support\Collection;

class EmployeeScheduleMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (ScheduleModel $item) {
            return self::toArray($item);
        });
    }

    public static function toArray(ScheduleModel $scheduleModel)
    {
        return [
            'id' => $scheduleModel->getId(),
            'name' => $scheduleModel->getName(),
            'address' => $scheduleModel->getAddress(),
            'postcode' => $scheduleModel->getPostCode(),
            'city' => $scheduleModel->getCity(),
            'date' => $scheduleModel->getDate()->toDateString(),
            'driver' => UserModelMapper::toArray($scheduleModel->getDriver()),
            'shift' => $scheduleModel->getAvailabilityShiftId() == 1 ? "Hele dag" : "Halve dag",
            'partner' => PartnerModelMapper::toArray($scheduleModel->getPartner())
        ];
    }
}
