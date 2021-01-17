<?php


namespace Tests\Feature;


use App\Partner;
use App\Project;
use App\Schedule;
use App\User;
use Tests\TestCase;

class PartnerDeleteTest extends TestCase
{
    public function testDelete()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $partner = factory(Partner::class)->create();

        $response = $this->post('/api/partners/' . $partner->id . '/delete', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    public function testDeleteNoPartnerFound()
    {
        $api_token = 'testtoken' . rand(1, 1000012);
        $user = factory(User::class)->create([
            'is_active' => true,
            'api_token' => $api_token,
            'role_id' => 1
        ]);

        $response = $this->post('/api/partners/' . 0 . '/delete', [], [
            'api-key' => $api_token
        ]);

        $response->assertStatus(404);
    }
}
