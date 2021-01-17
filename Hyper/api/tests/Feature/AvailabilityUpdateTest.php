<?php

namespace Tests\Feature;

use App\Availability;
use App\AvailabilityShift;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailabilityUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id
        ]);

        $response = $this->post('api/availabilities/' . $availability->id . '/update', [
            'api_token' => $user->api_token,
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => $shift->id
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'items' => [
                'id',
                'date',
                'is_present',
                'user_id',
                'availability_shift_id'
            ],
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateInvalidId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $response = $this->post('api/availabilities/' . 0 . '/update', [
            'api_token' => $user->api_token,
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => $shift->id
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testUpdateInvalidShiftId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id
        ]);

        $response = $this->post('api/availabilities/' . $availability->id . '/update', [
            'api_token' => $user->api_token,
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => 0
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testUpdateInvalidApiToken()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id
        ]);

        $response = $this->post('api/availabilities/' . $availability->id . '/update', [
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => $shift->id
        ], [
            'api-key' => 'abc'
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testUpdateExceededDate()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $shift = factory(AvailabilityShift::class)->create();

        $availability = factory(Availability::class)->create([
            'user_id' => $user->id,
            'availability_shift_id' => $shift->id
        ]);

        $response = $this->post('api/availabilities/' . $availability->id . '/update', [
            'api_token' => $user->api_token,
            'date' => Carbon::now()->toDateString(),
            'is_present' => true,
            'availability_shift_id' => 1,
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(409);
    }
}
