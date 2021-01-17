<?php

namespace App\Http\Controllers\Subscription;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Exceptions\Subscription\SubscriptionNotFoundException;
use App\Http\Requests\Pagination\SubscriptionPaginationRequest;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Http\Requests\Subscription\SubscriptionUpdateRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationSubscriptionModelMapper;
use App\Src\Mappers\Hyper\Subscription\SubscriptionModelMapper;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Subscription\IDeleteSubscriptionService;
use App\Src\Services\Hyper\Subscription\IStoreSubscriptionService;
use App\Src\Services\Hyper\Subscription\ISubscriptionService;
use App\Src\Services\Hyper\Subscription\IUpdateSubscriptionService;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * @var ISubscriptionService
     */
    private $subscriptionService;

    /**
     * @var IStoreSubscriptionService
     */
    private $subscriptionStoreService;

    /**
     * @var IUpdateSubscriptionService
     */
    private $subscriptionUpdateService;

    /**
     * @var IDeleteSubscriptionService
     */
    private $subscriptionDeleteService;

    public function __construct(
        ISubscriptionService $subscriptionService,
        IStoreSubscriptionService $storeSubscriptionService,
        IUpdateSubscriptionService $updateSubscriptionService,
        IDeleteSubscriptionService $deleteSubscriptionService
    ) {
        $this->subscriptionService = $subscriptionService;
        $this->subscriptionStoreService = $storeSubscriptionService;
        $this->subscriptionUpdateService = $updateSubscriptionService;
        $this->subscriptionDeleteService = $deleteSubscriptionService;
    }

    /**
     * @param SubscriptionPaginationRequest $subscriptionPaginationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(SubscriptionPaginationRequest $subscriptionPaginationRequest)
    {
        $model = $subscriptionPaginationRequest->map();

        try {
            $results = $this->subscriptionService->get($model);
            $mappedResults = PaginationModelMapper::toArray($results, (new PaginationSubscriptionModelMapper()));

            return JsonResponse::ok($mappedResults);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param SubscriptionStoreRequest $subscriptionStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubscriptionStoreRequest $subscriptionStoreRequest)
    {
        try {
            $result = $this->subscriptionStoreService->store($subscriptionStoreRequest->toModel());
            $mappedResults = SubscriptionModelMapper::toArray($result);

            return JsonResponse::ok([
                'data' => $mappedResults
            ]);
        } catch (ProjectNotFoundException $projectNotFoundException) {
            return JsonResponse::notOk($projectNotFoundException->getMessage(), $projectNotFoundException->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @param SubscriptionUpdateRequest $subscriptionUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, SubscriptionUpdateRequest $subscriptionUpdateRequest)
    {
        try {
            $model = $subscriptionUpdateRequest->toModel();
            $model->setId((int)$id);

            $result = $this->subscriptionUpdateService->update($model);
            $mappedResults = SubscriptionModelMapper::toArray($result);
            return JsonResponse::ok([
                'data' => $mappedResults
            ]);
        } catch (SubscriptionNotFoundException $subscriptionNotFoundException) {
            return JsonResponse::notOk(
                $subscriptionNotFoundException->getMessage(),
                $subscriptionNotFoundException->getCode()
            );
        } catch (ProjectNotFoundException $projectNotFoundException) {
            return JsonResponse::notOk(
                $projectNotFoundException->getMessage(),
                $projectNotFoundException->getCode()
            );
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
            $this->subscriptionDeleteService->delete($id);

            return JsonResponse::ok([
                'message' => 'Successfully deleted subscription!'
            ]);
        } catch (SubscriptionNotFoundException $subscriptionNotFoundException) {
            return JsonResponse::notOk(
                $subscriptionNotFoundException->getMessage(),
                $subscriptionNotFoundException->getCode()
            );
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(int $id)
    {
        try {
            $results = $this->subscriptionService->findById($id);
            $mappedResults = SubscriptionModelMapper::toArray($results);
            return JsonResponse::ok($mappedResults);
        } catch (SubscriptionNotFoundException $subscriptionNotFoundException) {
            return JsonResponse::notOk(
                $subscriptionNotFoundException->getMessage(),
                $subscriptionNotFoundException->getCode()
            );
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
