<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MySalaryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMySalary()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/my-salaries', [
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->toDateString()
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }
}
