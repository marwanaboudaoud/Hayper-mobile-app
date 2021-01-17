<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\MyAvailabilityModel;

interface IMyAvailabilityService
{
    public function get(MyAvailabilityModel $availabilityModel);
}
