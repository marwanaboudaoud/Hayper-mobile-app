<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Src\Mappers\Hyper\Employee\EmployeeScheduleMapper;
use App\Src\Services\Hyper\Schedule\IMyScheduleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class MyScheduleController extends Controller
{
    /**
     * @var IMyScheduleService
     */
    private $myScheduleService;

    public function __construct(IMyScheduleService $myScheduleService)
    {
        $this->myScheduleService = $myScheduleService;
    }

    /**
     * @param EmployeeScheduleRequest $employeeScheduleRequest
     * @return JsonResponse
     */
    public function index(EmployeeScheduleRequest $employeeScheduleRequest)
    {
        $employeeScheduleSearchModel = $employeeScheduleRequest->map();
        try {
            $schedule = $this->myScheduleService->get($employeeScheduleSearchModel);
            return response()->json([
                'results' => EmployeeScheduleMapper::toCollectionArray($schedule)
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
