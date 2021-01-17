<?php

namespace Tests\Feature;

use App\Address;
use App\EmploymentContract;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractCreateOrDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws \Exception
     */
    public function testCreateContract()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 2
        ]);

        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);

        $contract = factory(EmploymentContract::class)->create([
            'start_date' => new Carbon('2020-01-19'),
            'end_date' => new Carbon('2020-01-19'),
            'trial_per_day' => 20,
            'user_id' => $user->id,
            'document_number' => sha1(rand(1, 100) * 10),
        ]);

        $response = $this->post('/api/contracts/create-or-delete', [
            'is_extended' => true,
            'contract_id' => $contract->id
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(200);
    }

}
