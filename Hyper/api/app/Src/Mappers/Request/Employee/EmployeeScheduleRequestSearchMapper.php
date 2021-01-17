<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use Carbon\Carbon;

class EmployeeScheduleRequestSearchMapper
{
    /**
     * @param EmployeeScheduleRequest $employeeScheduleRequest
     * @return PaginationEmployeeScheduleModel
     */
    public static function toModel(EmployeeScheduleRequest $employeeScheduleRequest)
    {
        $start = Carbon::createFromFormat('Y-m-d', $employeeScheduleRequest->start_date);
        $end = Carbon::createFromFormat('Y-m-d', $employeeScheduleRequest->end_date);

        return (new PaginationEmployeeScheduleModel())
            ->setApiToken($employeeScheduleRequest->header('api-key'))
            ->setStartDate($start)
            ->setEndDate($end);
    }
}
