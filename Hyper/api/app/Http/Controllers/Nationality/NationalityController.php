<?php

namespace App\Http\Controllers\Nationality;

use App\Src\Mappers\Hyper\Nationality\NationalityModelMapper;
use App\Src\Responses\JsonCollectionResponse;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Nationality\INationalityService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NationalityController extends Controller
{
    /**
     * @var INationalityService
     */
    private $nationalityService;

    public function __construct(INationalityService $nationalityService)
    {
        $this->nationalityService = $nationalityService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $results = $this->nationalityService->get();
            $mappedResults = NationalityModelMapper::toCollectionArray($results);
            return JsonCollectionResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
