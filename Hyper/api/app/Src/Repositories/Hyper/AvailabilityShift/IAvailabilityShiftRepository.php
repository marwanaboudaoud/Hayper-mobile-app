<?php


namespace App\Src\Repositories\Hyper\AvailabilityShift;

use App\Src\Models\Hyper\AvailabilityShift\AvailabilityShiftModel;

interface IAvailabilityShiftRepository
{
    public function find(int $id);
}
