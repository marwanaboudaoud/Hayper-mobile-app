<?php


namespace App\Src\Services\Hyper\Schedule;

use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;

interface IMyScheduleService
{
    public function get(PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel);
}
