<?php

namespace App\Http\Controllers\Employee;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\EmergencyContact\EmergencyContactNotFoundException;
use App\Exceptions\Employee\EmployeeAddressModelNotSetException;
use App\Exceptions\Employee\EmployeeEmergencyContactModelNotSetException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Exceptions\Employee\ActivateTokenAlreadyUsedException;
use App\Exceptions\Employee\ActivateTokenNotSetException;
use App\Exceptions\Employee\EmployeeEmailAlreadyExistsException;
use App\Exceptions\Role\RoleNotFoundException;
use App\Http\Requests\Employee\EmployeeActivateRequest;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Http\Requests\Pagination\EmployeePaginationRequest;
use App\Http\Requests\Pagination\ExportPaginationRequest;
use App\Http\Requests\Pagination\PaginationRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationUserModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Employee\IEmployeeActivateService;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Employee\IEmployeeStoreService;
use App\Src\Services\Hyper\Employee\IEmployeeUpdateService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Notify\Mailable\EmployeeStoreMailNotifyService;
use App\Src\Services\Hyper\Export\Employee\EmployeeExportCsvService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeeController extends Controller
{
    /**
     * @var IEmployeeService
     */
    private $employeeService;

    /**
     * @var IEmployeeStoreService
     */
    private $employeeStoreService;

    /**
     * @var IEmployeeUpdateService
     */
    private $employeeUpdateService;

    /**
     * @var IEmployeeActivateService
     */
    private $employeeActivateService;

    /**
     * @var IEmployeeStoreNotifyService
     */
    private $employeeStoreMailNotifyService;

    public function __construct(
        IEmployeeService $employeeService,
        IEmployeeStoreService $employeeStoreService,
        IEmployeeUpdateService $employeeUpdateService,
        IEmployeeActivateService $employeeActivateService
    ) {
        $this->employeeService = $employeeService;
        $this->employeeStoreService = $employeeStoreService;
        $this->employeeUpdateService = $employeeUpdateService;
        $this->employeeActivateService = $employeeActivateService;
    }

    /**
     * @param EmployeePaginationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EmployeePaginationRequest $request)
    {
        $paginationModel = $request->map();

        try {
            $result = $this->employeeService->get($paginationModel);

            $mappedResult = PaginationModelMapper::toArray(
                $result,
                (new PaginationUserModelMapper)
            );

            return JsonResponse::ok($mappedResult);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param EmployeeStoreRequest $employeeStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        EmployeeStoreRequest $employeeStoreRequest
    ) {
        $userModel = $employeeStoreRequest->map();

        try {
            $result = $this->employeeStoreService->store($userModel);
            $mappedResult = UserModelMapper::toArray($result);

            return JsonResponse::ok([
                'message' => 'Created successfully',
                'data' => $mappedResult
            ]);
        } catch (EmployeeEmailAlreadyExistsException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (RoleNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param EmployeeActivateRequest $employeeActivateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(EmployeeActivateRequest $employeeActivateRequest)
    {
        $activateModel = $employeeActivateRequest->map();

        try {
            $this->employeeActivateService->activate($activateModel);

            return JsonResponse::ok([], 204);
        } catch (ActivateTokenNotSetException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (ActivateTokenAlreadyUsedException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($id)
    {
        try {
            $result = $this->employeeService->find($id);
            $mappedResult = UserModelMapper::toArray($result);

            return JsonResponse::ok($mappedResult);
        } catch (EmployeeNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @param EmployeeUpdateRequest $employeeUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, EmployeeUpdateRequest $employeeUpdateRequest)
    {
        $userModel = $employeeUpdateRequest->map();

        try {
            $result = $this->employeeUpdateService->update($id, $userModel);
            $mappedResult = UserModelMapper::toArray($result);

            return JsonResponse::ok([
                'message' => 'User successfully updated!',
                'data' => $mappedResult
            ]);
        } catch (EmployeeAddressModelNotSetException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (EmployeeEmergencyContactModelNotSetException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (EmployeeNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (AddressNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (EmergencyContactNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param EmployeeExportCsvService $exportExcelService
     * @param ExportPaginationRequest $paginationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateExport(
        EmployeeExportCsvService $exportExcelService,
        ExportPaginationRequest $paginationRequest
    ) {
        $model = $paginationRequest->map();

        try {
            $id = $exportExcelService->generate($model);
            $fileUrl = asset('api/employees/export-download/' . $id);

            return JsonResponse::ok(['url' => $fileUrl]);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @param EmployeeExportCsvService $exportExcelService
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadExport($id, EmployeeExportCsvService $exportExcelService)
    {
        $file = 'storage/' . $id . '.csv';

        try {
            return $exportExcelService->export($file);
        } catch (FileNotFoundException $exception) {
            return JsonResponse::notOk('File not found!', $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
