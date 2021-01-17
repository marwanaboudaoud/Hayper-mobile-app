<?php

namespace App\Http\Controllers\Project;

use App\Exceptions\Partner\PartnerNotFoundException;
use App\Exceptions\Project\ProjectAttachedException;
use App\Exceptions\Project\ProjectNotFoundException;
use App\Http\Requests\Pagination\PaginationRequest;
use App\Http\Requests\Pagination\ProjectPaginationRequest;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationPartnerModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationProjectModelMapper;
use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Project\IProjectDeleteService;
use App\Src\Services\Hyper\Project\IProjectService;
use App\Src\Services\Hyper\Project\IProjectStoreService;
use App\Http\Controllers\Controller;
use App\Src\Services\Hyper\Project\IProjectUpdateService;

class ProjectController extends Controller
{
    /**
     * @var IProjectService
     */
    private $projectService;

    /**
     * @var IProjectStoreService
     */
    private $projectStoreService;

    /**
     * @var IProjectUpdateService
     */
    private $projectUpdateService;

    /**
     * @var IProjectDeleteService
     */
    private $projectDeleteService;

    public function __construct(
        IProjectService $projectService,
        IProjectStoreService $projectStoreService,
        IProjectUpdateService $projectUpdateService,
        IProjectDeleteService $projectDeleteService
    ) {
        $this->projectService = $projectService;
        $this->projectStoreService = $projectStoreService;
        $this->projectUpdateService = $projectUpdateService;
        $this->projectDeleteService = $projectDeleteService;
    }

    /**
     * @param ProjectPaginationRequest $projectPaginationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProjectPaginationRequest $projectPaginationRequest)
    {
        $projectModel = $projectPaginationRequest->map();
        try {
            $result = $this->projectService->get($projectModel);
            $mappedResult = PaginationModelMapper::toArray(
                $result,
                (new PaginationProjectModelMapper())
            );

            return JsonResponse::ok($mappedResult);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param ProjectStoreRequest $request
     * @return JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function store(ProjectStoreRequest $request)
    {
        $projectModel = $request->map();

        try {
            $result = $this->projectStoreService->store($projectModel);
            $mappedResult = ProjectModelMapper::toArray($result);

            return JsonResponse::ok(['message' => 'Successful Stored', 'data' => $mappedResult]);
        } catch (PartnerNotFoundException $exception) {
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
            $result = $this->projectService->find($id);
            $mappedResult = ProjectModelMapper::toArray($result);

            return JsonResponse::ok($mappedResult);
        } catch (ProjectNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param $id
     * @param ProjectUpdateRequest $request
     * @return JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function update($id, ProjectUpdateRequest $request)
    {
        $model = $request->map($id);

        try {
            $result = $this->projectUpdateService->update($model);
            $mappedResult = ProjectModelMapper::toArray($result);

            return JsonResponse::ok(['items' => $mappedResult]);
        } catch (ProjectNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (PartnerNotFoundException $exception) {
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
            $this->projectDeleteService->delete($id);

            return JsonResponse::ok(['message' => 'Project Successfully deleted!']);
        } catch (ProjectNotFoundException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (ProjectAttachedException $exception) {
            return JsonResponse::notOk($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
