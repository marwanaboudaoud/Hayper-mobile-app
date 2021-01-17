<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityModel;

interface IAvailabilityDateValidatorService
{
    public function validate(AvailabilityModel $availabilityModel);
}
