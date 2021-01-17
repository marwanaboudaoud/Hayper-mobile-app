<?php


namespace App\Src\Mappers\Hyper\Availability;

use App\Availability;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Carbon\Carbon;

class AvailabilityModelMapper
{
    public static function toEloquentModel(AvailabilityModel $availabilityModel)
    {
        $model = new Availability();
        $model->date = $availabilityModel->getDate()->toDateString();
        $model->is_present = $availabilityModel->isPresent();
        $model->user_id = $availabilityModel->getUserId();
        $model->availability_shift_id = $availabilityModel->getAvailabilityShiftId();

        return $model;
    }

    public static function toArray(AvailabilityModel $availabilityModel)
    {
        return [
            'id' => $availabilityModel->getId(),
            'date' => $availabilityModel->getDate()->toDateString(),
            'is_present' => $availabilityModel->isPresent(),
            'user_id' => $availabilityModel->getUserId(),
            'availability_shift_id' => $availabilityModel->getAvailabilityShiftId()
        ];
    }

    public static function toEloquentUpdateModel(AvailabilityModel $oldModel, AvailabilityModel $newModel)
    {
        $model = new Availability();
        $model->id = $oldModel->getId();
        $model->date = $newModel->getDate()->toDateString() ?? $oldModel->getDate()->toDateString();
        $model->is_present = $newModel->isPresent() ?? $oldModel->isPresent();
        $model->user_id = $newModel->getUserId() ?? $oldModel->getUserId();
        $model->availability_shift_id = $newModel->getAvailabilityShiftId() ?? $oldModel->getAvailabilityShiftId();
        $model->exists = true;

        return $model;
    }
}
