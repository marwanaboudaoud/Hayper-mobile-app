<?php

namespace Tests\Feature;

use App\Availability;
use App\AvailabilityShift;
use App\User;
use Tests\TestCase;

class EmployeeAvailabilityAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEmployeeAvailability()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $loginUser->id,
            'availability_shift_id' => $shift->id,
            'date' => "2020-01-02"
        ]);

        $response = $this->post('/api/my-availability', [
            'start_date' => "2020-01-02",
            'end_date' => "2020-02-02",
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'results' => [
                [
                    'id',
                    'user_id',
                    'present',
                    'date',
                    'availability_shift_id',
                ]
            ]
        ]);
    }

    public function noAvailabilityFound()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/employee/my-availability', [
            'start_date' => "2020-01-02",
            'end_date' => "2020-02-02",
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'results' => [
                [
                    'id',
                    'user_id',
                    'present',
                    'date',
                    'availability_shift_id',
                ]
            ]
        ]);
    }
}
