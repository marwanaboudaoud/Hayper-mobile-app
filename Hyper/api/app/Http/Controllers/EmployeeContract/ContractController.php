<?php

namespace App\Http\Controllers\EmployeeContract;

use App\EmploymentContract;
use App\Exceptions\Contract\ContractNotFoundException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Http\Requests\Contract\ContractStoreRequest;
use App\Http\Requests\Contract\EmployeeContractActionRequest;
use App\Http\Requests\Contract\EmployeeContractRequest;
use App\Src\Services\Hyper\Contract\ContractActionService;
use App\Src\Services\Hyper\Contract\IContractService;
use App\Src\Services\Hyper\Contract\IContractStoreService;
use App\Http\Requests\Pagination\ContractSearchRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationContractModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Contract\ContractStoreService;
use App\Src\Services\Hyper\Contract\IContractActionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ContractController extends Controller
{
    /**
     * @var IContractStoreService
     */
    protected $contractStoreService;

    /**
     * @var ContractActionService
     */
    protected $contractActionService;

    /**
     * @var IContractService
     */
    protected $contractService;


    /**
     * ContractController constructor.
     * @param IContractService $contractService
     * @param IContractStoreService $contractStoreService
     * @param IContractActionService $contractActionService
     */

    public function __construct(
        IContractService $contractService,
        IContractStoreService $contractStoreService,
        IContractActionService $contractActionService
    ) {
        $this->contractStoreService = $contractStoreService;
        $this->contractActionService = $contractActionService;
        $this->contractService = $contractService;
    }

    /**
     * @param ContractSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ContractSearchRequest $request)
    {
        try {
            $model = $request->map();

            $results = $this->contractService->get($model);

            $mappedArrayPagination = PaginationModelMapper::toArray(
                $results,
                (new PaginationContractModelMapper())
            );

            return JsonResponse::ok($mappedArrayPagination);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param ContractStoreRequest $contractStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContractStoreRequest $contractStoreRequest)
    {
        $contactModel = $contractStoreRequest->map();

        try {
            $this->contractStoreService->store($contactModel);

            return JsonResponse::ok(['message' => 'Created successfully']);
        } catch (EmployeeNotFoundException $employeeNotFoundException) {
            return JsonResponse::notOk(
                $employeeNotFoundException->getMessage(),
                $employeeNotFoundException->getCode()
            );
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param EmployeeContractActionRequest $contractActionRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrDelete(EmployeeContractActionRequest $contractActionRequest)
    {
        $employeeContractActionModel = $contractActionRequest->map();
        try {
            $this->contractActionService->createOrDelete($employeeContractActionModel);

            $message = $employeeContractActionModel->isExtended() == true ? 'Contract is extended' :
                'Contract has been removed successfully';

            return JsonResponse::ok([
                'message' => $message
            ]);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param EmployeeContractRequest $employeeContractRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function download(EmployeeContractRequest $employeeContractRequest)
    {
        $employeeContractModel = $employeeContractRequest->map();
        try {
            return $this->contractService->export($employeeContractModel);
        } catch (FileNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'File not found!'
                ],
                500
            );
        } catch (ContractNotFoundException $contractNotFoundException) {
            return response()->json([
                'message' => $contractNotFoundException->getMessage()
            ], $contractNotFoundException->getCode());
        }
    }
}
