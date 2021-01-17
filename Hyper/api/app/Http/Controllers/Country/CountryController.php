<?php

namespace App\Http\Controllers\Country;

use App\Src\Mappers\Hyper\Country\CountryModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Country\ICountryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * @var ICountryService
     */
    private $countryService;

    /**
     * CountryController constructor.
     * @param ICountryService $countryService
     */
    public function __construct(ICountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        try {
            $results = $this->countryService->get();
            $mappedResults = CountryModelMapper::toCollectionArray($results);
            return JsonResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
