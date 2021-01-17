<?php

namespace App\Http\Controllers\Availability;

use App\Http\Requests\Availability\AvailabilitySearchRequest;
use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Src\Mappers\Hyper\Availability\AvailabilitySearchModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Availability\IAvailabilitySearchService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailabilitySearchController extends Controller
{
    /**
     * @var IAvailabilitySearchService
     */
    private $availabilitySearchService;

    public function __construct(IAvailabilitySearchService $availabilitySearchService)
    {
        $this->availabilitySearchService = $availabilitySearchService;
    }

    /**
     * @param AvailabilitySearchRequest $searchRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(AvailabilitySearchRequest $searchRequest)
    {
        try {
            $result = $this->availabilitySearchService->search($searchRequest->map());
            $mappedResult = AvailabilitySearchModelMapper::toCollectionArray($result);

            return JsonResponse::ok(['data' => $mappedResult]);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
