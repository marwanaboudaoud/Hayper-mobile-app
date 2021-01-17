<?php


namespace Tests\Feature;


use App\User;
use Carbon\Carbon;

class ContractStoreTest
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreContract()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post('/api/employees/store', [
            'start_date' => Carbon::today(),
            'end_date' => Carbon::tomorrow(),
            'trial_per_day' => 250,
            'user' => 4,
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testStoreInvalidUser()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post('/api/employees/store', [
            'start_date' => Carbon::today(),
            'end_date' => Carbon::tomorrow(),
            'trial_per_day' => 250,
            'user' => 0,
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(404);
    }
}
