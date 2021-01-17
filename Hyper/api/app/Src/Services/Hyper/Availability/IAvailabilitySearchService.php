<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;

interface IAvailabilitySearchService
{
    public function search(AvailabilitySearchModel $availabilitySearchModel);
}
