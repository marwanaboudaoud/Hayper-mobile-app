<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEmployees()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/employees', [
            'limit' => 1,
            'page' => 3,
            'order_by' => 'id',
            'direction' => 'asc'
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);

        $users = factory(User::class, 15);

        $response->assertJsonStructure([
            'page',
            'limit',
            'results' => [
                [
                    'id',
                    'alias',
                    'nmbrs_id',
                    'initials',
                    'first_name',
                    'insertion',
                    'last_name',
                    'phone',
                    'address',
                    'emergency_contact',
                    'has_drivers_license',
                    'date_of_birth',
                    'country_of_birth_id',
                    'nationality_id',
                    'marital_status_id',
                    'email',
                    'is_active',
                    'gender_id',
                    'role',
                    'location',
                    'into_service',
                    'out_of_service'
                ]
            ]
        ]);

        $loginUser->delete();

        foreach ($users as $user) {
            $user->delete();
        }
    }
}
