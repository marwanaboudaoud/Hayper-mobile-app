<?php

namespace App\Http\Controllers\Role;

use App\Exceptions\Role\RoleAlreadyExistsException;
use App\Exceptions\Role\RoleInUseException;
use App\Exceptions\Role\RoleNotFoundException;
use App\Http\Requests\Pagination\RolePaginationRequest;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\Pagination\PaginationRoleModelMapper;
use App\Src\Mappers\Hyper\Role\RoleModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use App\Src\Responses\JsonResponse;
use App\Src\Services\Hyper\Role\IRoleDeleteService;
use App\Src\Services\Hyper\Role\IRoleService;
use App\Src\Services\Hyper\Role\IRoleStoreService;
use App\Src\Services\Hyper\Role\IRoleUpdateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * @var IRoleService
     */
    private $roleService;

    /**
     * @var IRoleStoreService
     */
    private $roleStoreService;

    /**
     * @var IRoleUpdateService
     */
    private $roleUpdateService;

    /**
     * @var IRoleDeleteService
     */
    private $roleDeleteService;

    /**
     * RoleController constructor.
     * @param IRoleService $roleService
     * @param IRoleStoreService $roleStoreService
     * @param IRoleUpdateService $roleUpdateService
     * @param IRoleDeleteService $roleDeleteService
     */
    public function __construct(
        IRoleService $roleService,
        IRoleStoreService $roleStoreService,
        IRoleUpdateService $roleUpdateService,
        IRoleDeleteService $roleDeleteService
    ) {
        $this->roleService = $roleService;
        $this->roleStoreService = $roleStoreService;
        $this->roleUpdateService = $roleUpdateService;
        $this->roleDeleteService = $roleDeleteService;
    }

    /**
     * @param RolePaginationRequest $rolePaginationRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RolePaginationRequest $rolePaginationRequest)
    {
        $rolePaginationModel = $rolePaginationRequest->map();
        try {
            $result = $this->roleService->get($rolePaginationModel);
            $mappedResult = PaginationModelMapper::toArray(
                $result,
                (new PaginationRoleModelMapper())
            );

            return JsonResponse::ok($mappedResult);
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param RoleStoreRequest $roleStoreRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleStoreRequest $roleStoreRequest)
    {
        $roleModel = $roleStoreRequest->map();
        try {
            $result = $this->roleStoreService->store($roleModel);
            $mappedResult = RoleModelMapper::toArray($result);

            return JsonResponse::ok([
                'message' => 'Role has been created successfully',
                'data' => $mappedResult
            ]);
        } catch (RoleAlreadyExistsException $roleAlreadyExists) {
            return JsonResponse::notOk($roleAlreadyExists->getMessage(), $roleAlreadyExists->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    /**
     * @param int $id
     * @param RoleUpdateRequest $roleUpdateRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id, RoleUpdateRequest $roleUpdateRequest)
    {
        $roleModel = $roleUpdateRequest->map();
        try {
            $result = $this->roleUpdateService->update($id, $roleModel);
            $mappedResult = RoleModelMapper::toArray($result);

            return JsonResponse::ok([
                'message' => 'Role successfully updated!',
                'data' => $mappedResult
            ]);
        } catch (RoleNotFoundException $roleNotFoundException) {
            return JsonResponse::notOk($roleNotFoundException->getMessage(), $roleNotFoundException->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }

    public function delete($id)
    {
        try {
            $this->roleDeleteService->delete($id);

            return JsonResponse::ok([
                'message' => 'Role has been archived'
            ]);
        } catch (RoleInUseException $roleInUseException) {
            return JsonResponse::notOk($roleInUseException->getMessage(), $roleInUseException->getCode());
        } catch (RoleNotFoundException $roleNotFoundException) {
            return JsonResponse::notOk($roleNotFoundException->getMessage(), $roleNotFoundException->getCode());
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
            $results = $this->roleService->findById($id);
            $mappedResults = RoleModelMapper::toArray($results);

            return JsonResponse::ok($mappedResults);
        } catch (RoleNotFoundException $roleNotFoundException) {
            return JsonResponse::notOk($roleNotFoundException->getMessage(), $roleNotFoundException->getCode());
        } catch (\Exception $exception) {
            return JsonResponse::notOkException($exception);
        }
    }
}
