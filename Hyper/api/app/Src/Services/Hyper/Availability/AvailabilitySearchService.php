<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Mappers\Hyper\Availability\AvailabilitySearchModelMapper;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;

class AvailabilitySearchService implements IAvailabilitySearchService
{
    /**
     * @var IAvailabilityRepository
     */
    private $availabilityRepository;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;


    public function __construct(
        IAvailabilityRepository $availabilityRepository,
        IAvailabilityShiftService $availabilityShiftService
    ) {
        $this->availabilityRepository = $availabilityRepository;
        $this->availabilityShiftService = $availabilityShiftService;
    }

    public function search(AvailabilitySearchModel $availabilitySearchModel)
    {
        $this->availabilityShiftService::rules($availabilitySearchModel->getAvailabilityShiftIds());

        return $this->availabilityRepository->get($availabilitySearchModel);
    }
}
