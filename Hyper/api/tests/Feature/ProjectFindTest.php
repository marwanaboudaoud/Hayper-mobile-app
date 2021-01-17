<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectFindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $project = factory(Project::class)->create([
            'partner_id' => factory(Partner::class)->create()->id
        ]);

        $response = $this->get('/api/projects/' . $project->id, [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testFindNoExisting()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/projects/0', [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(404);
    }
}
