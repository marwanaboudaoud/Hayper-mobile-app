<?php

namespace App\Http\Controllers\Salary;

use App\Http\Requests\Salary\MySalaryRequest;
use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Services\Hyper\Salary\IMySalaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MySalaryController extends Controller
{
    /**
     * @var IMySalaryService
     */
    private $mySalaryService;

    public function __construct(IMySalaryService $salaryService)
    {
        $this->mySalaryService = $salaryService;
    }

    /**
     * @param MySalaryRequest $request
     * @return JsonResponse
     */
    public function index(MySalaryRequest $request)
    {
        $model = $request->map();

        try {
            $result = $this->mySalaryService->get($model);

            return response()->json([
                'result' => SalaryModelMapper::toCollectionArray($result)
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
