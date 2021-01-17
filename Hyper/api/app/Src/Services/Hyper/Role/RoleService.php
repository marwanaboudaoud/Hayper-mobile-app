<?php


namespace App\Src\Services\Hyper\Role;

use App\Exceptions\Role\RoleAlreadyExistsException;
use App\Exceptions\Role\RoleInUseException;
use App\Exceptions\Role\RoleNotFoundException;
use App\Src\Mappers\Hyper\Role\RoleModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationRoleModel;
use App\Src\Repositories\Hyper\Role\IRoleRepository;

class RoleService implements IRoleService
{
    /**
     * @var IRoleRepository
     */
    private $roleRepository;

    /**
     * RoleService constructor.
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param PaginationRoleModel $paginationRoleModel
     * @return mixed
     */
    public function get(PaginationRoleModel $paginationRoleModel)
    {
        return $this->roleRepository->get($paginationRoleModel);
    }

    /**
     * @param string $title
     * @return mixed|void
     * @throws RoleAlreadyExistsException
     */
    public function findByTitle(string $title)
    {
        $foundRole = $this->roleRepository->findByTitle($title);

        if ($foundRole) {
            throw new RoleAlreadyExistsException();
        }

        return $foundRole;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws RoleNotFoundException
     */
    public function findById(int $id)
    {
        $foundRole = $this->roleRepository->findById($id);
        if (!$foundRole) {
            throw new RoleNotFoundException();
        }

        return $foundRole;
    }

    /**
     * @param int $id
     * @return mixed|void
     * @throws RoleInUseException
     */
    public function getRoleWithRelation(int $id)
    {
        $roleWithRelations = $this->roleRepository->getRoleWithRelation($id);
        if (sizeof($roleWithRelations->users) > 0) {
            throw new RoleInUseException();
        }
    }
}
