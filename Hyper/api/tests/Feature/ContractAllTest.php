<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/contracts', [
            'limit' => 1,
            'page' => 3,
            'order_by' => 'id',
            'direction' => 'asc'
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
