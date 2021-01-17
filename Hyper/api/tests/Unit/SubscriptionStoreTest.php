<?php

namespace Tests\Unit;

use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Models\Hyper\Subscription\HistorySubscriptionModel;
use App\Src\Models\Hyper\Subscription\SubscriptionModel;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use App\Src\Services\Hyper\Project\IProjectService;
use App\Src\Services\Hyper\Subscription\IStoreHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\StoreSubscriptionService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class SubscriptionStoreTest extends TestCase
{
    /**
     * @var ISubscriptionRepository
     */
    private $subscriptionRepository;

    /**
     * @var IProjectService
     */
    private $projectService;
    /**
     * @var IStoreHistorySubscriptionService|m\LegacyMockInterface|m\MockInterface
     */
    private $subscriptionHistory;

    public function setUp(): void
    {
        parent::setUp();

        $this->subscriptionRepository = m::mock(ISubscriptionRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(SubscriptionModel::class)
                ->andReturn((new SubscriptionModel()));
        });

        $this->projectService = m::mock(IProjectService::class, function ($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn((new ProjectModel()));
        });

        $this->subscriptionHistory = m::mock(IStoreHistorySubscriptionService::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(HistorySubscriptionModel::class);
        });


    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStore()
    {
        $model = (new SubscriptionModel())->setProjectId(1);

        $service = new StoreSubscriptionService($this->subscriptionRepository, $this->projectService, $this->subscriptionHistory);
        $result = $service->store($model);

        $this->assertInstanceOf(SubscriptionModel::class, $result);
    }
}
