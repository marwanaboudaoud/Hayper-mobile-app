<?php


namespace App\Src\Repositories\Hyper\AvailabilityShift;

use App\AvailabilityShift;
use App\Src\Mappers\Hyper\AvailabilityShift\AvailabilityShiftEloquentModelMapper;
use App\Src\Models\Hyper\AvailabilityShift\AvailabilityShiftModel;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;

class AvailabilityShiftRepository implements IAvailabilityShiftRepository
{
    /**
     * @param int $id
     * @return AvailabilityShiftModel|null
     */
    public function find(int $id)
    {
        $model = AvailabilityShift::find($id);

        if (!$model) {
            return null;
        }

        return AvailabilityShiftEloquentModelMapper::toModel($model);
    }
}
