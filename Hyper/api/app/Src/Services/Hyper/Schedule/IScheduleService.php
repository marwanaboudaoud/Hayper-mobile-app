<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Schedule\ScheduleModel;
use Illuminate\Support\Collection;

interface IScheduleService
{
    /**
     * @param int $weekNr
     * @param int $year
     * @return Collection
     */
    public function get(int $weekNr, int $year);
}
