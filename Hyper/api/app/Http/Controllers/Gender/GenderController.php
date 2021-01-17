<?php

namespace App\Http\Controllers\Gender;

use App\Src\Mappers\Hyper\Gender\GenderModelMapper;
use App\Src\Responses\JsonCollectionResponse;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Gender\IGenderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenderController extends Controller
{
    /**
     * @var IGenderService
     */
    private $genderService;

    /**
     * GenderController constructor.
     * @param IGenderService $genderService
     */
    public function __construct(IGenderService $genderService)
    {
        $this->genderService = $genderService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $results = $this->genderService->get();
            $mappedResults = GenderModelMapper::toCollectionArray($results);
            return JsonCollectionResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
