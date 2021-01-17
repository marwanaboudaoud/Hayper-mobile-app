<?php

namespace Tests\Unit;

use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use App\Src\Repositories\Hyper\Salary\ISalaryRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
use App\Src\Services\Hyper\Salary\SalaryService;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class SalaryGetServiceTest extends TestCase
{
    private $salaryRepository;
    /**
     * @var ISalaryRowRepository|m\LegacyMockInterface|m\MockInterface
     */
    private $salaryRowRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->salaryRepository = m::mock(ISalaryRepository::class, function ($mock) {
            $mock->shouldReceive('get')
                ->andReturn(
                    collect()
                );
        });

        $this->salaryRowRepository = m::mock(ISalaryRowRepository::class, function ($mock) {});
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGet()
    {
        $service = new SalaryService($this->salaryRepository, $this->salaryRowRepository);
        $result = $service->get((new SalaryPaginationModel()));

        $this->assertInstanceOf(Collection::class, $result);
    }
}
