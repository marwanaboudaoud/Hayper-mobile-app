<?php

namespace App\Http\Controllers\Schedule;

use App\Exceptions\Availability\AvailabilityNotFoundException;
use App\Exceptions\Availability\NoAvailableDriveException;
use App\Exceptions\NoAvailabilityFoundException;
use App\Exceptions\Schedule\ScheduledEmployeeException;
use App\Exceptions\Schedule\ScheduleNotFoundException;
use App\Exceptions\Schedule\WeekNumberNotValidException;
use App\Exceptions\Schedule\YearNotValidException;
use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Http\Requests\Schedule\ScheduleRequest;
use App\Http\Requests\Schedule\ScheduleStoreRequest;
use App\Http\Requests\Schedule\ScheduleUpdateRequest;
use App\Src\Mappers\Hyper\Employee\EmployeeScheduleMapper;
use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Mappers\Hyper\Schedule\ScheduleEloquentMapper;
use App\Src\Mappers\Hyper\Schedule\ScheduleModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Schedule\IScheduleDeleteService;
use App\Src\Services\Hyper\Schedule\IScheduleService;
use App\Src\Services\Hyper\Schedule\IScheduleStoreService;
use App\Src\Services\Hyper\Schedule\IScheduleUpdateService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * @var IScheduleService
     */
    private $scheduleService;

    /**
     * @var IScheduleStoreService
     */
    private $scheduleStoreService;

    /**
     * @var IScheduleUpdateService
     */
    private $scheduleUpdateService;

    /**
     * @var IScheduleDeleteService
     */
    private $scheduleDeleteService;

    public function __construct(
        IScheduleService $scheduleService,
        IScheduleStoreService $scheduleStoreService,
        IScheduleUpdateService $scheduleUpdateService,
        IScheduleDeleteService $scheduleDeleteService
    ) {
        $this->scheduleService = $scheduleService;
        $this->scheduleStoreService = $scheduleStoreService;
        $this->scheduleUpdateService = $scheduleUpdateService;
        $this->scheduleDeleteService = $scheduleDeleteService;
    }

    /**
     * @param ScheduleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ScheduleRequest $request)
    {
        try {
            $results = $this->scheduleService->get($request->week, $request->year);
            $mappedResults = ProjectModelMapper::toCollectionArray($results);

            return JsonResponse::ok(['data' => $mappedResults]);
        } catch (WeekNumberNotValidException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (YearNotValidException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param ScheduleStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ScheduleStoreRequest $request)
    {
        $model = $request->map();

        try {
            $result = $this->scheduleStoreService->storeCollection($model);
            $mappedResult = ScheduleModelMapper::toCollectionArray($result);

            return JsonResponse::ok(['items' => $mappedResult]);
        } catch (NoAvailabilityFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (ScheduledEmployeeException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (NoAvailableDriveException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @param ScheduleUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, ScheduleUpdateRequest $request)
    {
        $model = $request->map();
        $model->setId($id);

        try {
            $result = $this->scheduleUpdateService->update($model);
            $mappedResult = ScheduleModelMapper::toArray($result);

            return JsonResponse::ok(['items' => $mappedResult]);
        } catch (ScheduleNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $this->scheduleDeleteService->delete($id);

            return JsonResponse::ok(['message' => 'Successfully deleted!']);
        } catch (ScheduleNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
