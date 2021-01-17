<?php

namespace Tests\Unit;

use App\Exceptions\Project\ProjectAttachedException;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Repositories\Hyper\Project\ProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;
use App\Src\Services\Hyper\Project\ProjectDeleteService;
use mysql_xdevapi\Exception;
use Tests\TestCase;
use Mockery as m;

class ProjectDeleteServiceTest extends TestCase
{
    /**
     * @var IProjectRepository
     */
    private $projectRepo;

    private $invalidProjectRepo;

    private $invalidProjectRepoWithGreaterThanZeroCount;
    /**
     * @var IProjectRepository|m\LegacyMockInterface|m\MockInterface
     */
    private $commissionDeleteService;

    public function setUp(): void
    {
        parent::setUp();

        $this->projectRepo = m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    (new ProjectModel())->setId(1)
                );

            $mock->shouldReceive('countProjectEmployees')
                ->with(1)
                ->andReturn(
                    0
                );

            $mock->shouldReceive('delete')
                ->with(1)
                ->andReturn(
                    true
                );
        });

        $this->invalidProjectRepo = m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    null
                );
        });

        $this->invalidProjectRepoWithGreaterThanZeroCount = m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(
                    (new ProjectModel())->setId(1)
                );

            $mock->shouldReceive('countProjectEmployees')
                ->with(1)
                ->andReturn(
                    1
                );
        });

        $this->commissionDeleteService = m::mock(ICommissionRateDeleteService::class, function ($mock) {
            $mock->shouldReceive('deleteByProjectId')
                ->with(1)
                ->andReturn(
                    true
                );
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $service = new ProjectDeleteService(
            $this->projectRepo,
            $this->commissionDeleteService
        );
        $result = $service->delete(1);

        $this->assertTrue($result);
    }

    public function testDeleteNoFoundProject()
    {
        $this->expectException(\Exception::class);

        $service = new ProjectDeleteService(
            $this->invalidProjectRepo,
            $this->commissionDeleteService
        );
        $service->delete(1);
    }

    public function testHasEmployees()
    {
        $this->expectException(ProjectAttachedException::class);

        $service = new ProjectDeleteService(
            $this->invalidProjectRepoWithGreaterThanZeroCount,
            $this->commissionDeleteService
        );
        $service->delete(1);
    }
}
