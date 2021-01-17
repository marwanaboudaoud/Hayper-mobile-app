<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Exceptions\Schedule\ScheduleNotFoundException;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use Illuminate\Support\Collection;

class ScheduleUpdateService implements IScheduleUpdateService
{
    /**
     * @var IScheduleRepository
     */
    protected $scheduleRepository;

    public function __construct(IScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    public function updateCollection(Collection $collection)
    {
        return $collection->map(
            function (ScheduleModel $item) {
                return $this->update($item);
            }
        );
    }

    /**
     * @param  ScheduleModel $updatedModel
     * @throws ScheduleNotFoundException
     */
    public function update(ScheduleModel $updatedModel)
    {
         $model = $this->scheduleRepository->findById($updatedModel->getId());

        if (!$model) {
            throw new ScheduleNotFoundException();
        }

         return $this->scheduleRepository->update($updatedModel);
    }
}
