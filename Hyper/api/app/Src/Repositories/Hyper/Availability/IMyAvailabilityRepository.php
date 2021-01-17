<?php


namespace App\Src\Repositories\Hyper\Availability;

use App\Src\Models\Hyper\Availability\MyAvailabilityModel;

interface IMyAvailabilityRepository
{
    public function get(MyAvailabilityModel $availabilityModel);
}
