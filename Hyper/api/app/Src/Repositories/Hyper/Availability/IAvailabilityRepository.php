<?php


namespace App\Src\Repositories\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityCountModel;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;

interface IAvailabilityRepository
{
    public function store(AvailabilityModel $availabilityModel);

    public function findBy(array $args);

    public function findByIdAndUserId(int $id, int $userId);

    public function update(AvailabilityModel $availabilityModel);

    public function count(AvailabilityCountModel $availabilityFindModel);

    public function get(AvailabilitySearchModel $availabilitySearchModel);
}
