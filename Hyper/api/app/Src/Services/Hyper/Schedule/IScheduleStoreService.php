<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Support\Collection;

interface IScheduleStoreService
{
    public function storeCollection(Collection $collection);

    public function store(ScheduleModel $scheduleModel);
}
