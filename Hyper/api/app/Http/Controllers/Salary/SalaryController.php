<?php

namespace App\Http\Controllers\Salary;

use App\Exceptions\Salary\SalaryNotFoundException;
use App\Http\Requests\Pagination\SalaryPaginationRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationSalaryModelMapper;
use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Repositories\Hyper\Salary\SalaryRepository;
use App\Src\Repositories\Hyper\Salary\SalaryRowRepository;
use App\Src\Services\Hyper\Salary\ISalaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    /**
     * @var ISalaryService
     */
    private $salaryService;

    public function __construct(ISalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * @param SalaryPaginationRequest $salaryPaginationRequest
     * @return JsonResponse
     */
    public function index(SalaryPaginationRequest $salaryPaginationRequest)
    {
        $model = $salaryPaginationRequest->map();

        try {
            $result = $this->salaryService->get($model);

            $data = PaginationModelMapper::toArray(
                $result,
                (new PaginationSalaryModelMapper())
            );

            return response()->json(
                $data
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function find($id)
    {
        try {
            $result = $this->salaryService->find($id);

            $data = SalaryModelMapper::toArray($result);

            return response()->json([
                'data' => $data
            ]);
        } catch (SalaryNotFoundException $salaryNotFoundException) {
            return response()->json([
                'message' => $salaryNotFoundException->getMessage()
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
