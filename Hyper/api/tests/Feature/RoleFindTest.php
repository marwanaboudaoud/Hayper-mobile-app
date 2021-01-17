<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\Subscription;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleFindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get(
            '/api/roles/' . 1,
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(200);
    }

    public function testInvalidRoleId()
    {
        $user = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post(
            '/api/roles/' . 0,
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(405);
    }
}
