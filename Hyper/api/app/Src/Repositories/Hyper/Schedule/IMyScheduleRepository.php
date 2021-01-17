<?php


namespace App\Src\Repositories\Hyper\Schedule;

use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;

interface IMyScheduleRepository
{
    public function get(PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel);
}
