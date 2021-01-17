<?php

namespace Tests\Feature;

use App\Salary;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalaryManualStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $salary = factory(Salary::class)->create([
            'is_closed' => 0
        ]);


        $response = $this->post(
            '/api/salaries-manual/'. $salary->id .'/store',
            [
                'date' => Carbon::now()->toDateString(),
                'price' => 1.99,
                'description' => 'hekllo'
            ],
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(200);
    }

    public function testIsClosedStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $salary = factory(Salary::class)->create([
            'is_closed' => 1
        ]);


        $response = $this->post(
            '/api/salaries-manual/'. $salary->id .'/store',
            [
                'date' => Carbon::now()->toDateString(),
                'price' => 1.99,
                'description' => 'hekllo'
            ],
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(409);
    }

    public function testInvalidSalaryId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);


        $response = $this->post(
            '/api/salaries-manual/0/store',
            [
                'date' => Carbon::now()->toDateString(),
                'price' => 1.99,
                'description' => 'hekllo'
            ],
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(404);
    }
}
