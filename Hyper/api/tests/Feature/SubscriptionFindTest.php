<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\Subscription;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionFindTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $subscription = factory(Subscription::class)->create([
            'project_id' => factory(Project::class)->create([
                'partner_id' => factory(Partner::class)->create()->id
            ])->id
        ]);

        $response = $this->get(
            '/api/subscriptions/' . $subscription->id,
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(200);
    }

    public function testInvalidSubscriptionId()
    {
        $user = factory(User::class)->create([
            'is_active' => true
        ]);

        $response = $this->post(
            '/api/subscriptions/' . 0,
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(405);
    }
}
