<?php

namespace App\Http\Controllers\Salary;

use App\Exceptions\Salary\SalaryDeleteException;
use App\Exceptions\Salary\SalaryNotFoundException;
use App\Exceptions\Salary\SalaryRowNotFound;
use App\Exceptions\SalaryRowManual\SalaryClosedException;
use App\Http\Requests\Salary\SalaryManualStoreRequest;
use App\Src\Mappers\Hyper\Salary\SalaryDayModelMapper;
use App\Src\Mappers\Hyper\Salary\SalaryManualModelMapper;
use App\Src\Services\Hyper\Salary\ISalaryDayStoreService;
use App\Src\Services\Hyper\Salary\ISalaryRowManualDeleteService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SalaryManualController extends Controller
{
    /**
     * @var ISalaryDayStoreService
     */
    private $salaryManualStore;

    /**
     * @var ISalaryRowManualDeleteService
     */
    private $salaryRowManualDeleteService;

    public function __construct(
        ISalaryDayStoreService $salaryDayStoreService,
        ISalaryRowManualDeleteService $salaryRowManualDeleteService
    ) {
        $this->salaryManualStore = $salaryDayStoreService;
        $this->salaryRowManualDeleteService = $salaryRowManualDeleteService;
    }

    /**
     * @param SalaryManualStoreRequest $manualStoreRequest
     * @param $salaryId
     * @return JsonResponse
     */
    public function store(SalaryManualStoreRequest $manualStoreRequest, $salaryId)
    {
        try {
            $model = $manualStoreRequest->map();
            $model->setSalaryId($salaryId);

            $salary = $this->salaryManualStore->store($model);
            $salaryManual = SalaryDayModelMapper::toSalaryManualModel($salary);
            return response()->json(SalaryManualModelMapper::toArray($salaryManual));
        } catch (SalaryClosedException $salaryClosedException) {
            return response()->json([
                'message' => $salaryClosedException->getMessage()
            ], $salaryClosedException->getCode());
        } catch (SalaryNotFoundException $salaryNotFoundException) {
            return response()->json([
                'message' => $salaryNotFoundException->getMessage()
            ], $salaryNotFoundException->getCode());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        try {
            $this->salaryRowManualDeleteService->delete($id);
            return response()->json([
                'message' => 'Row has been deleted'
            ], 200);
        } catch (SalaryClosedException $salaryClosedException) {
            return response()->json([
                'message' => $salaryClosedException->getMessage()
            ], $salaryClosedException->getCode());
        } catch (SalaryDeleteException $salaryDeleteException) {
            return response()->json([
                'message' => $salaryDeleteException->getMessage()
            ], $salaryDeleteException->getCode());
        } catch (SalaryRowNotFound $salaryRowNotFound) {
            return response()->json([
                'message' => $salaryRowNotFound->getMessage()
            ], $salaryRowNotFound->getCode());
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }
}
