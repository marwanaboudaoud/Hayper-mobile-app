<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDelete()
    {
        $project = factory(Project::class)->create(
            ['partner_id' => factory(Partner::class)->create()->id]
        );

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/projects/' . $project->id . '/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteInvalidId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/projects/0/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(404);
    }

    public function testAlreadyAttached()
    {
        $project = factory(Project::class)->create([
            'partner_id' => factory(Partner::class)->create()->id
        ]);

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $project->employees()->sync($user->id);

        $response = $this->post('/api/projects/' . $project->id . '/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(409);
    }
}
