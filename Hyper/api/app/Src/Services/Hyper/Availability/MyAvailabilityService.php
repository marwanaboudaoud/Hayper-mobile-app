<?php


namespace App\Src\Services\Hyper\Availability;

use App\Src\Models\Hyper\Availability\MyAvailabilityModel;
use App\Src\Repositories\Hyper\Availability\IMyAvailabilityRepository;

class MyAvailabilityService implements IMyAvailabilityService
{

    /**
     * @var IMyAvailabilityRepository
     */
    protected $myAvailabilityRepository;

    public function __construct(IMyAvailabilityRepository $myAvailabilityRepository)
    {
        $this->myAvailabilityRepository = $myAvailabilityRepository;
    }

    public function get(MyAvailabilityModel $availabilityModel)
    {
        return $this->myAvailabilityRepository->get($availabilityModel);
    }
}
