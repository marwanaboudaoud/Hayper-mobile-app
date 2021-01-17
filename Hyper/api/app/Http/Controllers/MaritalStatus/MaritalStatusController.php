<?php

namespace App\Http\Controllers\MaritalStatus;

use App\Src\Mappers\Hyper\MaritalStatus\MaritalStatusModelMaper;
use App\Src\Responses\JsonCollectionResponse;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\MaritalStatus\IMaritalStatusService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaritalStatusController extends Controller
{
    /**
     * @var IMaritalStatusService
     */
    private $maritalStatusService;

    public function __construct(IMaritalStatusService $maritalStatusService)
    {
        $this->maritalStatusService = $maritalStatusService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $results = $this->maritalStatusService->get();
            $mappedResults = MaritalStatusModelMaper::toCollectionArray($results);
            return JsonCollectionResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
