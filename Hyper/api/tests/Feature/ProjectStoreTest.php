<?php

namespace Tests\Feature;

use App\Partner;
use App\User;
use Tests\TestCase;

class ProjectStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/projects/store', [
            'name' => 'John Wick',
            'is_active' => true,
            'partner_id' => factory(Partner::class)->create()->id

            ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
