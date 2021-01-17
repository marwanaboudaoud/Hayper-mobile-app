<?php

namespace App\Http\Controllers\Availability;

use App\Http\Requests\Employee\Availability\EmployeeAvailabilityRequest;
use App\Src\Mappers\Hyper\User\Availability\UserAvailabilityModelMapper;
use App\Src\Responses\JsonCollectionResponse;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Availability\IMyAvailabilityService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyAvailabilityController extends Controller
{
    /**
     * @var IMyAvailabilityService
     */
    private $myAvailabilityService;

    public function __construct(IMyAvailabilityService $myAvailabilityService)
    {
        $this->myAvailabilityService = $myAvailabilityService;
    }

    /**
     * @param EmployeeAvailabilityRequest $employeeAvailabilityRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EmployeeAvailabilityRequest $employeeAvailabilityRequest)
    {
        $employeeAvailabilityModel = $employeeAvailabilityRequest->map();
        try {
            $results = $this->myAvailabilityService->get($employeeAvailabilityModel);
            $mappedResults = UserAvailabilityModelMapper::toCollectionArray($results);

            return JsonCollectionResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
