<?php

namespace Tests\Unit\Mappers\Hyper\Project;

use App\Project;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectModelMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToCollection()
    {
        $projects = collect([
            (new ProjectModel())->setName('test')
        ]);

        $projects = ProjectModelMapper::toCollectionArray($projects);

        $this->assertInstanceOf(Collection::class, $projects);
    }

    public function testToModel()
    {
        $model = (new ProjectModel())->setName('test');

        $project = ProjectModelMapper::toArray($model);

        $this->assertIsArray($project);
    }
}
