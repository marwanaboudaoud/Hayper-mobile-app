<?php

namespace Tests\Unit;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Project;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateStoreService;
use App\Src\Services\Hyper\Partner\IPartnerService;
use App\Src\Services\Hyper\Project\ProjectUpdateService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ProjectUpdateServiceTest extends TestCase
{
    /**
     * @var ProjectModel
     */
    private $projectModel;

    /**
     * @var IProjectRepository
     */
    private $repo;

    /**
     * @var IPartnerRepository
     */
    private $partnerRepo;

    /**
     * @var IProjectRepository
     */
    private $repoNotFound;
    /**
     * @var ICommissionRateStoreService|m\LegacyMockInterface|m\MockInterface
     */
    private $commissionStoreService;
    /**
     * @var \Illuminate\Support\Collection
     */
    private $collect;
    /**
     * @var ICommissionRateStoreService|m\LegacyMockInterface|m\MockInterface
     */
    private $commissionDeleteService;

    public function setUp(): void
    {
        $this->collect = collect();

        $this->projectModel = m::mock(ProjectModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getPartnerId')
                ->andReturn(1);

            $mock->shouldReceive('getCommissionRates')
                ->andReturn(
                    $this->collect
                );
        });

        $this->repo = m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->projectModel);

            $mock->shouldReceive('update')
                ->with(ProjectModel::class)
                ->andReturn(true);
        });

        $this->partnerRepo = m::mock(IPartnerService::class, function ($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn(true);
        });

        $this->repoNotFound =  m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(null);
        });

        $this->commissionStoreService = m::mock(ICommissionRateStoreService::class, function ($mock) {
            $mock->shouldReceive('storeCollection')
                ->with($this->collect)
                ->andReturn($this->collect);
        });

        $this->commissionDeleteService = m::mock(ICommissionRateDeleteService::class, function ($mock) {
            $mock->shouldReceive('deleteByProjectId')
                ->with(1)
                ->andReturn(true);
        });

        parent::setUp();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws ProjectNotFoundException
     */
    public function testUpdate()
    {
        $service = new ProjectUpdateService(
            $this->repo,
            $this->partnerRepo,
            $this->commissionStoreService,
            $this->commissionDeleteService
        );

        $result = $service->update($this->projectModel);

        $this->assertTrue($result);
    }

    /**
     * @throws ProjectNotFoundException
     */
    public function testUpdateWithNoExistingProject()
    {
        $this->expectException(ProjectNotFoundException::class);

        $service = new ProjectUpdateService(
            $this->repoNotFound,
            $this->partnerRepo,
            $this->commissionStoreService,
            $this->commissionDeleteService
        );

        $service->update($this->projectModel);
    }
}
