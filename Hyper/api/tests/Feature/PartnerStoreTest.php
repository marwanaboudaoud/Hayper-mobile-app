<?php

namespace Tests\Feature;

use App\Partner;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PartnerStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/partners/store', [
            'name' => 'James',
            'address' => 'Olijf',
            'house_number' => '152 a',
            'postcode' => '8224cp',
            'city' => 'Istanbul',
            'phone' => '+112 202 2900 222'

        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
