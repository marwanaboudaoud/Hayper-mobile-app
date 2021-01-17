<?php

namespace Tests\Feature;

use App\Partner;
use App\Project;
use App\Subscription;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDelete()
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

        $response = $this->post(
            '/api/subscriptions/'. $subscription->id .'/delete',
            [
            ],
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(200);
    }

    public function testDeleteInvalidSubscriptionId()
    {
        $user = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $response = $this->post(
            '/api/subscriptions/'. 0 .'/delete',
            [
            ],
            [
                'api-key' => $user->api_token
            ]
        );

        $response->assertStatus(404);
    }
}
