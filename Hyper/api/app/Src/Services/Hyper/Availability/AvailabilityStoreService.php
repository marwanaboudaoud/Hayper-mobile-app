<?php


namespace App\Src\Services\Hyper\Availability;

use App\Exceptions\Availability\DateExceededExpireDate;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use App\Src\Services\Hyper\Auth\IAuthService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use Carbon\Carbon;

class AvailabilityStoreService implements IAvailabilityStoreService
{
    /**
     * @var IAvailabilityDateValidatorService
     */
    private $dateValidateService;

    /**
     * @var IAvailabilityRepository
     */
    private $availabilityRepository;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;

    /**
     * @var IAuthService
     */
    private $authService;

    public function __construct(
        IAvailabilityRepository $availabilityRepository,
        IAvailabilityShiftService $availabilityShiftService,
        IAuthService $authService,
        IAvailabilityDateValidatorService $dateValidatorService
    ) {
        $this->availabilityRepository = $availabilityRepository;
        $this->availabilityShiftService = $availabilityShiftService;
        $this->authService = $authService;
        $this->dateValidateService = $dateValidatorService;
    }

    /**
     * @param AvailabilityModel $availabilityModel
     * @return AvailabilityModel
     */
    public function store(AvailabilityModel $availabilityModel)
    {
        $this->dateValidateService->validate($availabilityModel);

        if ($availabilityModel->isPresent()) {
            $this->availabilityShiftService->find($availabilityModel->getAvailabilityShiftId());
        } else {
            $availabilityModel->setAvailabilityShiftId(null);
        }

        $userModel = $this->authService->checkApiToken($availabilityModel->getApiToken());

        $availabilityModel->setUserId($userModel->getId());

        return $this->availabilityRepository->store($availabilityModel);
    }
}
