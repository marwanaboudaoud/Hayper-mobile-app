<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\Subscription;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionAllTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAll()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        factory(Subscription::class)->create([
            'project_id' => factory(Project::class)->create([
                'partner_id' => factory(Partner::class)->create()->id
            ])->id
        ]);

        $response = $this->post('/api/subscriptions', [
            'limit' => 3,
            'page' => 1,
            'order_by' => 'id'
        ], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllWithoutArgs()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post('/api/subscriptions', [], [
            'api-key' => $user->api_token
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAllWithoutUser()
    {
        factory(Subscription::class)->create([
            'project_id' => factory(Project::class)->create([
                'partner_id' => factory(Partner::class)->create()->id
            ])->id
        ]);

        $response = $this->post('/api/subscriptions', [
            'limit' => 3,
            'page' => 1,
            'order_by' => 'id'
        ], []);

        $response->assertStatus(422);
    }
}
