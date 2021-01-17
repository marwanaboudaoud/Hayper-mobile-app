<?php

namespace Tests\Unit\Mappers\Hyper\Salary;

use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Models\Hyper\Salary\SalaryTotalPerDayModel;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class SalaryModelMapperTest extends TestCase
{
    /**
     * @var SalaryModel
     */
    protected $salaryModel;

    /**
     * @var SalaryModel
     */
    private $invalidSalaryModel;

    /**
     * @var SalaryTotalPerDayModel
     */
    private $salaryRowRepository;
    /**
     * @var SalaryTotalPerDayModel
     */
    private $salaryRowNullRepository;



    public function setUp(): void
    {
        parent::setUp();

        $this->salaryModel = m::mock(SalaryModel::class, function ($mock) {
            $mock->shouldReceive('getSalaryDays')
                ->andReturn(collect([
                    (new SalaryDayModel())->setId(1)
                ]));
        });

        $this->invalidSalaryModel = m::mock(SalaryModel::class, function ($mock) {
            $mock->shouldReceive('getSalaryDays')
                ->andReturn(collect());
        });



        $collectionSalaryPerDayModelsExcl = collect([
            (new SalaryTotalPerDayModel())
                ->setId(1)
                ->setSalary(1.99)
        ]);

        $collectionSalaryPerDayModelsBonus = collect([
            (new SalaryTotalPerDayModel())
                ->setId(1)
                ->setSalary(5.55)
        ]);

        $collectionSalaryPerDayModelsIncl = collect([
            (new SalaryTotalPerDayModel())
                ->setId(1)
                ->setSalary(2.53)
        ]);

        $this->salaryRowRepository = m::mock(ISalaryRowRepository::class, function ($mock) use (
            $collectionSalaryPerDayModelsExcl,
            $collectionSalaryPerDayModelsBonus,
            $collectionSalaryPerDayModelsIncl
        ) {
            $mock->shouldReceive('getSubTotalPerDayExclBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModelsExcl);

            $mock->shouldReceive('getSubTotalPerDayBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModelsBonus);

            $mock->shouldReceive('getSubTotalPerDayInclBonusBySalaryId')
                ->with(1)
                ->andReturn($collectionSalaryPerDayModelsIncl);
        });

        $this->salaryRowNullRepository = m::mock(ISalaryRowRepository::class, function ($mock) use (
            $collectionSalaryPerDayModelsExcl,
            $collectionSalaryPerDayModelsBonus,
            $collectionSalaryPerDayModelsIncl
        ) {
            $mock->shouldReceive('getSubTotalPerDayExclBonusBySalaryId')
                ->with(1)
                ->andReturn(collect());

            $mock->shouldReceive('getSubTotalPerDayBonusBySalaryId')
                ->with(1)
                ->andReturn(collect());

            $mock->shouldReceive('getSubTotalPerDayInclBonusBySalaryId')
                ->with(1)
                ->andReturn(collect());
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMap()
    {
        $subTotalExBonus = $this->salaryRowRepository->getSubTotalPerDayExclBonusBySalaryId(1);
        $subTotalBonus = $this->salaryRowRepository->getSubTotalPerDayBonusBySalaryId(1);
        $subTotalInclBonus = $this->salaryRowRepository->getSubTotalPerDayInclBonusBySalaryId(1);

        $salary = SalaryModelMapper::toModelWithSubTotal(
            $this->salaryModel,
            $subTotalExBonus,
            $subTotalBonus,
            $subTotalInclBonus
        );

        $this->assertInstanceOf(Collection::class, $salary->getSalaryDays());
        $this->assertInstanceOf(SalaryDayModel::class, $salary->getSalaryDays()->first());
    }

    public function testSubTotalNullMap()
    {
        $subTotalExBonus = $this->salaryRowNullRepository->getSubTotalPerDayExclBonusBySalaryId(1);
        $subTotalBonus = $this->salaryRowNullRepository->getSubTotalPerDayBonusBySalaryId(1);
        $subTotalInclBonus = $this->salaryRowNullRepository->getSubTotalPerDayInclBonusBySalaryId(1);

        $salary = SalaryModelMapper::toModelWithSubTotal(
            $this->invalidSalaryModel,
            $subTotalExBonus,
            $subTotalBonus,
            $subTotalInclBonus
        );

        $this->assertInstanceOf(Collection::class, $salary->getSalaryDays());
    }
}
