<?php

namespace Tests\Unit\Mappers\Hyper\Project;

use App\Project;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectEloquentMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToCollection()
    {
        $projects = factory(Project::class, 3)->make([
            'partner_id' => null
        ]);

        $projects = ProjectEloquentMapper::toCollectionModel($projects);

        $this->assertInstanceOf(Collection::class, $projects);
    }

    public function testToModel()
    {
        $project = factory(Project::class)->make([
            'partner_id' => null
        ]);

        $project = ProjectEloquentMapper::toModel($project);

        $this->assertInstanceOf(ProjectModel::class, $project);
    }
}
