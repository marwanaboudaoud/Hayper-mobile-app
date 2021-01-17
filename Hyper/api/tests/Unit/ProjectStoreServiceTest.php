<?php

namespace Tests\Unit;


use App\Exceptions\Partner\PartnerNotFoundException;
use App\Partner;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateStoreService;
use App\Src\Services\Hyper\Partner\IPartnerService;
use App\Src\Services\Hyper\Partner\PartnerService;
use App\Src\Services\Hyper\Project\ProjectStoreService;
use Tests\TestCase;
use Mockery as m;

class ProjectStoreServiceTest extends TestCase
{
    /**
     * @var IProjectRepository
     */
    private $repo;

    /**
     * @var IPartnerService
     */
    private $partnerService;

    /**
     * @var ProjectModel
     */
    private $projectModel;
    /**
     * @var ICommissionRateDeleteService|m\LegacyMockInterface|m\MockInterface
     */
    private $commissionDeleteService;

    private $collect;

    public function setUp(): void
    {
        parent::setUp();

        $this->collect = collect();

        $this->projectModel =  m::mock(ProjectModel::class, function($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getPartnerId')
                ->andReturn(1);

            $mock->shouldReceive('getCommissionRates')
                ->andReturn(
                    $this->collect
                );
        });

        $this->partnerMock = m::mock(PartnerModel::class, function ($mock) { });

        $this->partnerService = m::mock(PartnerService::class, function($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn(
                    $this->partnerMock
                );
        });

        $this->repo = $this->instance(IProjectRepository::class, m::mock(IProjectRepository::class, function($mock) {
            $mock->shouldReceive('store')
                ->with(ProjectModel::class)
                ->andReturn($this->projectModel);

            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->projectModel);
        }));

        $this->commissionStoreService = m::mock(ICommissionRateStoreService::class, function ($mock) {
            $mock->shouldReceive('storeCollection')
                ->with($this->collect)
                ->andReturn($this->collect);
        });

    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws PartnerNotFoundException
     */
    public function testStore()
    {
        $service = new ProjectStoreService($this->repo, $this->partnerService, $this->commissionStoreService);
        $result = $service->store($this->projectModel);

        $this->assertInstanceOf(ProjectModel::class, $result);
    }
}
