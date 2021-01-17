<?php

namespace Tests\Unit;


use App\Exceptions\Partner\PartnerNotFoundException;
use App\Exceptions\Role\RoleAlreadyExistsException;
use App\Exceptions\Role\RoleInUseException;
use App\Exceptions\Role\RoleNotFoundException;
use App\Partner;
use App\Role;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Repositories\Hyper\Role\IRoleRepository;
use App\Src\Services\Hyper\Partner\IPartnerService;
use App\Src\Services\Hyper\Partner\PartnerService;
use App\Src\Services\Hyper\Project\ProjectStoreService;
use App\Src\Services\Hyper\Role\IRoleService;
use App\Src\Services\Hyper\Role\RoleService;
use App\Src\Services\Hyper\Role\RoleStoreService;
use Tests\TestCase;
use Mockery as m;

class RoleServiceTest extends TestCase
{
    /**
     * @var IRoleRepository
     */
    private $roleRepoFound;

    /**
     * @var IRoleRepository
     */
    private $roleRepoNotFound;

    /**
     * @var IRoleService
     */
    private $roleServiceFound;

    /**
     * @var RoleModel
     */
    private $roleModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->roleModel = m::mock(RoleModel::class, function ($mock) {
            $mock->shouldReceive('setId')
                ->andReturn(1);

            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('setTitle')
                ->andReturn($mock);

            $mock->shouldReceive('getTitle')
                ->andReturn("test title");

            $mock->shouldReceive('setCodeInNmbrs')
                ->andReturn($mock);

            $mock->shouldReceive('getCodeInNmbrs')
                ->andReturn(101);
        });

        $this->roleRepoFound = m::mock(IRoleRepository::class, function ($mock) {
            $mock->shouldReceive('findByTitle')
                ->with('test title')
                ->andReturn($this->roleModel);
        });

        $this->roleRepoNotFound = m::mock(IRoleRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(0);
        });


    }

    public function testRoleExists()
    {
        $this->expectException(RoleAlreadyExistsException::class);
        $service = new RoleService($this->roleRepoFound);
        $service->findByTitle('test title');
    }

    public function testRoleNotFound()
    {
        $this->expectException(RoleNotFoundException::class);
        $service = new RoleService($this->roleRepoNotFound);
        $service->findById(0);
    }

}
