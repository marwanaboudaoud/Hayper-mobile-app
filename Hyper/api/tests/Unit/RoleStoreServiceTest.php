<?php

namespace Tests\Unit;


use App\Exceptions\Partner\PartnerNotFoundException;
use App\Exceptions\Role\RoleAlreadyExistsException;
use App\Partner;
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
use App\Src\Services\Hyper\Role\RoleStoreService;
use Tests\TestCase;
use Mockery as m;

class RoleStoreServiceTest extends TestCase
{
    /**
     * @var IRoleRepository
     */
    private $roleRepo;

    /**
     * @var IRoleRepository
     */
    private $roleRepoFound;

    /**
     * @var IRoleService
     */
    private $roleService;

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
            $mock->shouldReceive('setTitle')
                ->andReturn($mock);

            $mock->shouldReceive('getTitle')
                ->andReturn("test title");

            $mock->shouldReceive('setCodeInNmbrs')
                ->andReturn($mock);

            $mock->shouldReceive('getCodeInNmbrs')
                ->andReturn(101);
        });


        $this->roleService = m::mock(IRoleService::class, function ($mock) {
            $mock->shouldReceive('findByTitle')
                ->with('test title')
                ->andReturn(null);
        });

        $this->roleRepo = m::mock(IRoleRepository::class, function ($mock) {
            $mock->shouldReceive('findByTitle')
                ->with('test title')
                ->andReturn(null);

            $mock->shouldReceive('store')
                ->with(RoleModel::class)
                ->andReturn($this->roleModel);

        });



    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $service = new RoleStoreService($this->roleRepo, $this->roleService);
        $result = $service->store($this->roleModel);

        $this->assertInstanceOf(RoleModel::class, $result);
    }


}
