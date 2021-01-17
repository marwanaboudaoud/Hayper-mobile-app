<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityModel;

interface IAvailabillityUpdateService
{
    public function update(AvailabilityModel $availabilityModel);
}
