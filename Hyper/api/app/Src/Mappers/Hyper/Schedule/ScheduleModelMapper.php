<?php


namespace App\Src\Mappers\Hyper\Schedule;

use App\Schedule;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Availability\AvailabilityCountModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Support\Collection;

class ScheduleModelMapper
{
    /**
     * @param ScheduleModel $scheduleModel
     * @return Schedule
     */
    public static function toEloquentModel(ScheduleModel $scheduleModel)
    {
        $model = new Schedule();
        $model->name = $scheduleModel->getName();
        $model->address = $scheduleModel->getAddress();
        $model->postcode = $scheduleModel->getPostcode();
        $model->city = $scheduleModel->getCity();
        $model->date = $scheduleModel->getDate()->toDateString();
        $model->project_id = $scheduleModel->getProjectId();
        $model->driver_id = $scheduleModel->getDriver()->getId();
        $model->availability_shift_id = $scheduleModel->getAvailabilityShiftId();

        return $model;
    }

    /**
     * @param ScheduleModel $oldModel
     * @param ScheduleModel $newModel
     * @return Schedule
     */
    public static function toEloquentUpdateModel(ScheduleModel $oldModel, ScheduleModel $newModel)
    {
        $model = new Schedule();
        $model->exists = true;
        $model->id = $oldModel->getId();
        $model->name = $newModel->getName() ?? $oldModel->getName();
        $model->address = $newModel->getAddress() ?? $oldModel->getAddress();
        $model->postcode = $newModel->getPostcode() ?? $oldModel->getPostcode();
        $model->city = $newModel->getCity() ?? $oldModel->getCity();
        $model->date = $newModel->getDate()->toDateString() ?? $oldModel->getDate()->toDateString();
        $model->project_id = $newModel->getProjectId() ?? $oldModel->getProjectId();
        $model->driver_id = $newModel->getDriver()->getId() ?? $oldModel->getDriver()->getId();
        $model->availability_shift_id = $newModel->getAvailabilityShiftId() ?? $oldModel->getAvailabilityShiftId();

        return $model;
    }

    /**
     * @param Collection|null $collection
     * @return array|Collection
     */
    public static function toCollectionArray(?Collection $collection)
    {
        if (!$collection) {
            return [];
        }

        return $collection->map(
            function ($item) {
                return self::toArray($item);
            }
        );
    }

    /**
     * @param ScheduleModel $scheduleModel
     * @return array
     */
    public static function toArray(ScheduleModel $scheduleModel)
    {
        return [
            'id' => $scheduleModel->getId(),
            'name' => $scheduleModel->getName(),
            'address' => $scheduleModel->getAddress(),
            'postcode' => $scheduleModel->getPostcode(),
            'city' => $scheduleModel->getCity(),
            'date' => $scheduleModel->getDate()->toDateString(),
            'availability_shift_id' => $scheduleModel->getAvailabilityShiftId(),
            'driver' => UserModelMapper::toArray($scheduleModel->getDriver()),
            'employees' => UserModelMapper::toCollectionArray($scheduleModel->getEmployees())
        ];
    }

    /**
     * @param ScheduleModel $scheduleModel
     * @return AvailabilityCountModel
     */
    public static function toAvailabilityFindEmployeesModel(ScheduleModel $scheduleModel)
    {
        return (new AvailabilityCountModel())
            ->setDate($scheduleModel->getDate())
            ->setEmployees($scheduleModel->getEmployees())
            ->setPresent(true)
            ->setDriver(false)
            ->setAvailabilityShiftIds(
                collect($scheduleModel->getAvailabilityShiftId())
            );
    }

    /**
     * @param ScheduleModel $scheduleModel
     * @return AvailabilityCountModel
     */
    public static function toAvailabilityFindDriverModel(ScheduleModel $scheduleModel)
    {
        return (new AvailabilityCountModel())->setDate($scheduleModel->getDate())
            ->setEmployees(collect([$scheduleModel->getDriver()]))
            ->setPresent(true)
            ->setDriver(true)
            ->setAvailabilityShiftIds(
                collect($scheduleModel->getAvailabilityShiftId())
            );
    }
}
