<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailabilityStoreTest extends TestCase
{
    public function testStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/availabilities/store', [
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => 1,
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'date',
            'is_present',
            'user_id',
            'availability_shift_id'
        ]);
    }

    public function testStoreExceededDate()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/availabilities/store', [
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

    public function testStorePresentFalse()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/availabilities/store', [
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => false,
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'id',
            'date',
            'is_present',
            'user_id',
            'availability_shift_id'
        ]);
        $response->assertStatus(200);
    }

    public function testInvalidStore()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $response = $this->post('/api/availabilities/store', [
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => 1,
        ], [
            'api-key' => 'abcd'
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(404);
    }

    public function testStoreInvalidAvailabilityShift()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/availabilities/store', [
            'api_token' => $user->api_token,
            'date' => Carbon::now()->addWeeks(2)->toDateString(),
            'is_present' => true,
            'availability_shift_id' => 0,
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertJsonStructure([
            'message'
        ]);
        $response->assertStatus(403);
    }
}
