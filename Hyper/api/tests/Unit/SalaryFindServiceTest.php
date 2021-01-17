<?php

namespace Tests\Unit;

use App\Exceptions\Salary\SalaryNotFoundException;
use App\SalaryDay;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Models\Hyper\Salary\SalaryTotalPerDayModel;
use App\Src\Repositories\Hyper\Salary\ISalaryRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
use App\Src\Services\Hyper\Salary\SalaryService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class SalaryFindServiceTest extends TestCase
{
    /**
     * @var SalaryModel
     */
    protected $salaryModel;

    /**
     * @var ISalaryRepository
     */
    protected $salaryRepository;

    /**
     * @var ISalaryRepository
     */
    protected $salaryNotFoundRepository;

    /**
     * @var ISalaryRowRepository
     */
    protected $salaryRowRepository;

    /**
     * @var ISalaryRowRepository
     */
    protected $salaryRowRepositoryNoSubTotals;

    public function setUp(): void
    {
        parent::setUp();

        $this->salaryModel = m::mock(SalaryModel::class, function ($mock) {
            $mock->shouldReceive('getSalaryDays')
                ->andReturn(collect([
                    (new SalaryDayModel())->setId(1)
                ]));
        });

        $collectionSalaryPerDayModels = collect([
            (new SalaryTotalPerDayModel())->setId(1)
        ]);

        $this->salaryRepository = m::mock(ISalaryRepository::class, function ($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn(
                    $this->salaryModel
                );
        });

        $this->salaryNotFoundRepository = m::mock(ISalaryRepository::class, function ($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn(
                    null
                );
        });

        $this->salaryRowRepository = m::mock(ISalaryRowRepository::class, function ($mock) use ($collectionSalaryPerDayModels){
            $mock->shouldReceive('getSubTotalPerDayExclBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModels);

            $mock->shouldReceive('getSubTotalPerDayBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModels);

            $mock->shouldReceive('getSubTotalPerDayInclBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModels);
        });
    }

    public function testFind()
    {
        $service = new SalaryService(
            $this->salaryRepository,
            $this->salaryRowRepository
        );

        $result = $service->find(1);

        $this->assertInstanceOf(SalaryModel::class, $result);
    }

    public function testFindWithInvalidId()
    {
        $this->expectException(SalaryNotFoundException::class);

        $service = new SalaryService(
            $this->salaryNotFoundRepository,
            $this->salaryRowRepository
        );

        $service->find(1);
    }
}
