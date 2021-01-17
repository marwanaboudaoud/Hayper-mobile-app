<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProjects()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $projects = factory(Project::class, 3)->create(
            ['partner_id' => factory(Partner::class)->create()->id]
        );

        $response = $this->post('/api/projects', [
            'limit' => 4,
            'page' => 2,
            'order_by' => 'id'
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);

        foreach ($projects as $project) {
            $project->delete();
        }
    }

    public function testProjectsWithoutLoginUser()
    {
        $projects = factory(Project::class, 3)->create([
            'partner_id' => factory(Partner::class)->create()->id
        ]);

        $response = $this->post('/api/projects');

        $response->assertStatus(422);

        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
