<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Schedule\ScheduleModel;

interface IScheduleDeleteService
{
    /**
     * @param  int $id
     * @return bool
     */
    public function delete(int $id);
}
