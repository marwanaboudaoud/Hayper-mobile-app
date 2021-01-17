<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetRoles()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/roles', [
            'limit' => 1,
            'page' => 3,
            'order_by' => 'id',
            'direction' => 'asc'
        ], [
            'api-key' => $loginUser->api_token
        ]);


        $response->assertStatus(200);

        $roles = factory(Role::class, 15);

        $response->assertJsonStructure([
            'page',
            'total_pages',
            'limit',
            'results' => [
                [
                    'id',
                    'title',
                    'code_in_nmbrs'
                ]
            ]
        ]);

        $loginUser->delete();

        foreach ($roles as $role) {
            $role->delete();
        }
    }
}
