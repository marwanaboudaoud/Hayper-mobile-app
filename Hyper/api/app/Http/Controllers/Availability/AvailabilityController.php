<?php

namespace App\Http\Controllers\Availability;

use App\Exceptions\Auth\UserNotActiveException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Exceptions\Availability\AvailabilityNotFoundException;
use App\Exceptions\Availability\DateExceededExpireDate;
use App\Exceptions\AvailabilityShift\AvailabilityShiftNotFoundException;
use App\Http\Requests\Availability\AvailabilityStoreRequest;
use App\Http\Requests\Availability\AvailabilityUpdateRequest;
use App\Http\Requests\Employee\Availability\EmployeeAvailabilityRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Src\Mappers\Hyper\Availability\AvailabilityModelMapper;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Availability\IAvailabilityStoreService;
use App\Src\Services\Hyper\Availability\IAvailabillityUpdateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailabilityController extends Controller
{
    /**
     * @var IAvailabilityStoreService
     */
    private $availabilityStoreService;

    /**
     * @var IAvailabillityUpdateService
     */
    private $availabilityUpdateService;

    public function __construct(
        IAvailabilityStoreService $availabilityStoreService,
        IAvailabillityUpdateService $availabilityUpdateService
    ) {
        $this->availabilityStoreService = $availabilityStoreService;
        $this->availabilityUpdateService = $availabilityUpdateService;
    }

    /**
     * @param AvailabilityStoreRequest $availabilityStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AvailabilityStoreRequest $availabilityStoreRequest)
    {
        try {
            $model = $availabilityStoreRequest->map();

            $result = $this->availabilityStoreService->store($model);

            $mappedModel = AvailabilityModelMapper::toArray($result);

            return JsonResponse::ok($mappedModel);
        } catch (DateExceededExpireDate $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (AvailabilityShiftNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (UserNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (UserNotActiveException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param AvailabilityUpdateRequest $availabilityUpdateRequest
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AvailabilityUpdateRequest $availabilityUpdateRequest, $id)
    {
        $model = $availabilityUpdateRequest->map();
        $model->setId($id);

        try {
            $result = $this->availabilityUpdateService->update($model);

            $mappedResult = AvailabilityModelMapper::toArray($result);

            return JsonResponse::ok(['items' => $mappedResult]);
        } catch (AvailabilityNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (AvailabilityShiftNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (UserNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (UserNotActiveException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (DateExceededExpireDate $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
