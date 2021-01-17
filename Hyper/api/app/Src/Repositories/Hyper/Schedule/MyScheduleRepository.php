<?php


namespace App\Src\Repositories\Hyper\Schedule;

use App\Src\Mappers\Hyper\Employee\EmployeeScheduleEloquentMapper;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\User;

class MyScheduleRepository implements IMyScheduleRepository
{
    public function get(PaginationEmployeeScheduleModel $paginationEmployeeScheduleModel)
    {
        $employeeSchedules = User::with(['schedules' => function ($query) use ($paginationEmployeeScheduleModel) {
            $query->with('driver');
            $query->with(['project' => function ($query) {
                $query->with('partner');
            }]);
            $query->whereBetween(
                'schedules.date',
                [
                    $paginationEmployeeScheduleModel->getStartDate()->toDate(),
                    $paginationEmployeeScheduleModel->getEndDate()->toDate()
                ]
            )->orderBy('schedules.date', 'asc');
        }])->where('api_token', $paginationEmployeeScheduleModel->getApiToken())->first();

        return EmployeeScheduleEloquentMapper::toCollection($employeeSchedules->schedules);
    }
}
