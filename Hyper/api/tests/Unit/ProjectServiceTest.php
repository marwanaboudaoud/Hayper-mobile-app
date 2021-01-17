<?php

namespace Tests\Unit;

use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\Project\ProjectService;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Mockery as m;

class ProjectServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $paginationProjectModel = m::mock(PaginationProjectModel::class, function ($mock) {
            $mock->shouldreceive('getProject')
                ->andreturn(m::mock(ProjectModel::class, function ($mock) {
                    $mock->shouldReceive('getId')
                        ->andReturn(1);
                    $mock->shouldReceive('getName')
                        ->andReturn('name');
                    $mock->shouldReceive('getSchedule')
                        ->andReturn(new Collection([
                            (new ProjectModel())->setName('name')
                        ]));
                    $mock->shouldReceive('getPartnerId')
                        ->andReturn(1);
                    $mock->shouldReceive('isActive')
                        ->andReturn(1);
                }));
        });
        $projectRepo = $this->instance(IProjectRepository::class, m::mock(IProjectRepository::class, function ($mock) {
            $mock->shouldReceive('get')
                ->with(PaginationProjectModel::class)
                ->andReturn(
                    new Collection()
                );
        }));

        $service = new ProjectService($projectRepo);
        $service->get($paginationProjectModel);
    }
}
