<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Exceptions\Schedule\ScheduleNotFoundException;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;

class ScheduleDeleteService implements IScheduleDeleteService
{
    /**
     * @var
     */
    protected $scheduleRepository;

    public function __construct(IScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param  int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $schedule = $this->scheduleRepository->findById($id);

        if (!$schedule) {
            throw new ScheduleNotFoundException();
        }

        return $this->scheduleRepository->delete($id);
    }
}
