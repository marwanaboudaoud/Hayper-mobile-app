<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyScoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMyScore()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/my-score', [], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
