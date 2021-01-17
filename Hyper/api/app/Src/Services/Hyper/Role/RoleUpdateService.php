<?php


namespace App\Src\Services\Hyper\Role;

use App\Src\Mappers\Hyper\Role\RoleModelMapper;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Repositories\Hyper\Role\IRoleRepository;

class RoleUpdateService implements IRoleUpdateService
{

    /**
     * @var IRoleService
     */
    private $roleService;

    /**
     * @var IRoleRepository
     */
    private $roleRepository;

    public function __construct(IRoleService $roleService, IRoleRepository $roleRepository)
    {
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param int $id
     * @param RoleModel $roleModel
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(int $id, RoleModel $roleModel)
    {
        $foundRole = $this->roleService->findById($id);
        return $this->roleRepository->update($id, $roleModel);
    }
}
