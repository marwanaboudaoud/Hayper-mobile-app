<?php


namespace App\Src\Repositories\Hyper\Schedule;

use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Carbon\Carbon;

interface IScheduleRepository
{
    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return mixed
     */
    public function get(Carbon $startDate, Carbon $endDate);

    /**
     * @param ScheduleModel $scheduleModel
     * @return mixed
     */
    public function store(ScheduleModel $scheduleModel);

    /**
     * @param ScheduleModel $updatedModel
     * @return mixed
     */
    public function update(ScheduleModel $updatedModel);

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param ScheduleModel $scheduleModel
     * @return mixed
     */
    public function scheduledEmployees(ScheduleModel $scheduleModel);
}
