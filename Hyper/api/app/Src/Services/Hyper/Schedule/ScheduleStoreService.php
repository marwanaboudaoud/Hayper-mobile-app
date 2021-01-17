<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Exceptions\Availability\NoAvailableDriveException;
use App\Exceptions\NoAvailabilityFoundException;
use App\Src\Mappers\Hyper\Schedule\ScheduleModelMapper;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use App\Src\Services\Hyper\Availability\IAvailabilityCountService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use Illuminate\Support\Collection;

class ScheduleStoreService implements IScheduleStoreService
{
    /**
     * @var IScheduleRepository
     */
    private $scheduleRepository;

    /**
     * @var IAvailabilityCountService
     */
    private $availabilityCountService;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;

    public function __construct(
        IScheduleRepository $scheduleRepository,
        IAvailabilityCountService $availabilityCountService,
        IAvailabilityShiftService $availabilityShiftService
    ) {
        $this->scheduleRepository = $scheduleRepository;
        $this->availabilityCountService = $availabilityCountService;
        $this->availabilityShiftService = $availabilityShiftService;
    }

    /**
     * @param ScheduleModel $scheduleModel
     * @return mixed
     * @throws NoAvailabilityFoundException
     * @throws NoAvailableDriveException
     */
    public function store(ScheduleModel $scheduleModel)
    {
//      Check user availability
        $avEmployeeModel = ScheduleModelMapper::toAvailabilityFindEmployeesModel($scheduleModel);
        $avDriverModel = ScheduleModelMapper::toAvailabilityFindDriverModel($scheduleModel);

        $this->availabilityShiftService::rules($avEmployeeModel->getAvailabilityShiftIds());
        $this->availabilityShiftService::rules($avDriverModel->getAvailabilityShiftIds());

        $countedAvailabilities = $this->availabilityCountService->count($avEmployeeModel);
        $countedAvailabilitiesDriver = $this->availabilityCountService->count($avDriverModel);

        $this->scheduleRepository->scheduledEmployees($scheduleModel);

        if (!$countedAvailabilities) {
            throw new NoAvailabilityFoundException();
        }

        if (!$countedAvailabilitiesDriver) {
            throw new NoAvailableDriveException();
        }

        return $this->scheduleRepository->store($scheduleModel);
    }

    public function storeCollection(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return $this->store($item);
            }
        );
    }
}
