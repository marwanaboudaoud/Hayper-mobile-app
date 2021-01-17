<?php


namespace App\Src\Services\Hyper\Role;

use App\Exceptions\Role\RoleNotFoundException;
use App\Src\Repositories\Hyper\Role\IRoleRepository;

class RoleDeleteService implements IRoleDeleteService
{
    /**
     * @var IRoleService
     */
    private $roleService;

    /**
     * @var IRoleRepository
     */
    private $roleRepository;

    const FIXED_ROLES = [1,2,3];

    /**
     * RoleDeleteService constructor.
     * @param IRoleService $roleService
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleService $roleService, IRoleRepository $roleRepository)
    {
        $this->roleService = $roleService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id)
    {
        if (in_array($id, self::FIXED_ROLES)) {
            throw new RoleNotFoundException();
        }

        $this->roleService->findById($id);
        $this->roleService->getRoleWithRelation($id);
        return $this->roleRepository->delete($id);
    }
}
