<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityCountModel;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use Illuminate\Support\Collection;

interface IAvailabilityCountService
{
    /**
     * @param AvailabilityCountModel $availabilityCountModel
     * @return Collection
     */
    public function count(AvailabilityCountModel $availabilityCountModel);
}
