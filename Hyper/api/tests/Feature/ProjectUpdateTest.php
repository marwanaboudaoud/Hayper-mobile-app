<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $project = factory(Project::class)->create(
            ['partner_id' => factory(Partner::class)->create()->id]
        );

        $response = $this->post('/api/projects/'. $project->id .'/update', [
            'name' => 'Mrs. Novella Runolfsson',
            'is_active' => true,
            'partner_id' => factory(Partner::class)->create()->id
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);;
        $response->assertJsonStructure([
            'items' => [
                'id',
                'name',
                'is_active',
                'partner_id'
            ]
        ]);

    }
}
