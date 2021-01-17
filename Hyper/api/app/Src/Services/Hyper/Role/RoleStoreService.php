<?php


namespace App\Src\Services\Hyper\Role;

use App\Exceptions\Role\RoleAlreadyExistsException;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Repositories\Hyper\Role\IRoleRepository;

class RoleStoreService implements IRoleStoreService
{
    /**
     * @var IRoleRepository
     */
    private $roleRepository;

    /**
     * @var IRoleService
     */
    private $roleService;

    /**
     * RoleStoreService constructor.
     * @param IRoleRepository $roleRepository
     * @param IRoleService $roleService
     */
    public function __construct(IRoleRepository $roleRepository, IRoleService $roleService)
    {
        $this->roleRepository = $roleRepository;
        $this->roleService = $roleService;
    }

    /**
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function store(RoleModel $roleModel)
    {
        $this->roleService->findByTitle($roleModel->getTitle());

        return $this->roleRepository->store($roleModel);
    }
}
