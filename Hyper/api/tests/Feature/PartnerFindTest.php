<?php


namespace Tests\Feature;


use App\Partner;
use App\User;
use Tests\TestCase;

class PartnerFindTest extends TestCase
{
    public function testFind()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $partner = factory(Partner::class)->create();

        $response = $this->get('/api/partners/' . $partner->id, [
            'api-key' => $loginUser->api_token
        ]);
        $response->assertStatus(200);
    }

    public function testFindNotFound()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->get('/api/partners/' . 0, [
            'api-key' => $loginUser->api_token
        ]);
        $response->assertStatus(404);
    }
}

