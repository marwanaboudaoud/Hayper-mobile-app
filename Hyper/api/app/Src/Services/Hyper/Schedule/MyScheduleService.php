<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\Src\Repositories\Hyper\Schedule\IMyScheduleRepository;

class MyScheduleService implements IMyScheduleService
{
    /**
     * @var IMyScheduleRepository
     */
    private $myScheduleRepository;

    public function __construct(IMyScheduleRepository $myScheduleRepository)
    {
        $this->myScheduleRepository = $myScheduleRepository;
    }

    public function get(PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel)
    {
        return $this->myScheduleRepository->get($paginationEmployeeScheduleModel);
    }
}
