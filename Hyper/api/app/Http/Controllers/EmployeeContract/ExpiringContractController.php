<?php

namespace App\Http\Controllers\EmployeeContract;

use App\Http\Requests\Contract\ContractExpiringRequest;
use App\Http\Requests\Contract\ContractStoreRequest;
use App\Http\Requests\Pagination\ContractExpiringPaginationRequest;
use App\Src\Mappers\Hyper\Contract\ContractExpireModelMapper;
use App\Src\Responses\JsonCollectionResponse;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Contract\ContractExpireService;
use App\Src\Services\Hyper\Contract\IContractExpireService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpiringContractController extends Controller
{
    /**
     * @var IContractExpireService
     */
    private $contractExpireService;

    public function __construct(IContractExpireService $contractExpireService)
    {
        $this->contractExpireService = $contractExpireService;
    }

    /**
     * @param ContractExpiringPaginationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ContractExpiringPaginationRequest $request)
    {
        $model = $request->map();

        try {
            $result = $this->contractExpireService->get($model);

            $mappedResult = ContractExpireModelMapper::toCollectionArray($result);

            return JsonCollectionResponse::ok($mappedResult);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
