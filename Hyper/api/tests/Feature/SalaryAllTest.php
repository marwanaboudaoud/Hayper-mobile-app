<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaryAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSalaries()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/salaries', [
            'limit' => 5,
            'page' => 1,
            'salary' => [
                'employee_name' => '',
                'date' => '',
                'heading' => '',
                'description' => '',
                'price' => null
            ],
            'filter' => [
                'month' => 1,
                'year' => 1973
            ]
        ], [
            'api-key' => $loginUser->api_token,
        ]);

        $response->assertStatus(200);
    }

    public function testSalariesWithoutLoginUser()
    {
        $response = $this->post('/api/salaries');

        $response->assertStatus(422);
    }
}
