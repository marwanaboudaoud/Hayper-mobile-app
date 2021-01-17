<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityModel;

interface IAvailabilityStoreService
{
    public function store(AvailabilityModel $availabilityModel);
}
