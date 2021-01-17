<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\AvailabilityCountModel;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use Illuminate\Support\Collection;

class AvailabilityCountService implements IAvailabilityCountService
{
    /**
     * @var IAvailabilityRepository
     */
    private $availabilityRepository;

    public function __construct(IAvailabilityRepository $availabilityRepository)
    {
        $this->availabilityRepository = $availabilityRepository;
    }

    /**
     * @param AvailabilityCountModel $availabilityCountModel
     * @return Collection
     */
    public function count(AvailabilityCountModel $availabilityCountModel)
    {
        return $this->availabilityRepository->count($availabilityCountModel);
    }
}
