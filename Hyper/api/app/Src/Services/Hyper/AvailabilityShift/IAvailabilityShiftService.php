<?php


namespace App\Src\Services\Hyper\AvailabilityShift;

use Illuminate\Support\Collection;

interface IAvailabilityShiftService
{
    public function find(int $id);

    public static function rules(Collection $collection);
}
