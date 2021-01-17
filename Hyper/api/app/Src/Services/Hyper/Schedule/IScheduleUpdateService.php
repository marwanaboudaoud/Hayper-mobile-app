<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Support\Collection;

interface IScheduleUpdateService
{
    public function updateCollection(Collection $collection);

    public function update(ScheduleModel $scheduleModel);
}
