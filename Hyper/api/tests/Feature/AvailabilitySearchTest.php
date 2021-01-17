<?php

namespace Tests\Feature;

use App\Availability;
use App\AvailabilityShift;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailabilitySearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSearch()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => 1,
            'is_present' => true
        ]);

        $response = $this->post('api/availabilities/search', [
            'date' => $availability->date,
            'is_driver' => false,
            'availability_shift_id' => 1
        ], [
            'api-key' => $user->api_token
        ]);
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name'
                ]
            ]
        ]);
    }

    public function testSearchDriver()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'has_drivers_license' => true,
            'role_id' => 1
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => 1,
            'is_present' => true
        ]);

        $response = $this->post('api/availabilities/search', [
            'date' => $availability->date,
            'is_driver' => true,
            'availability_shift_id' => 1
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name'
                ]
            ]
        ]);
    }
}
