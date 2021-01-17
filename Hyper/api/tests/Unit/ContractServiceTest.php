<?php

namespace Tests\Unit;

use App\Exceptions\Availability\DateExceededExpireDate;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use App\Src\Repositories\Hyper\Contract\IContractRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Auth\IAuthService;
use App\Src\Services\Hyper\Availability\AvailabilityStoreService;
use App\Src\Services\Hyper\Availability\IAvailabilityDateValidatorService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use App\Src\Services\Hyper\Contract\ContractExportService;
use App\Src\Services\Hyper\Contract\ContractService;
use App\User;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class ContractServiceTest extends TestCase
{
    /**
     * @var PaginationContractModel
     */
    private $paginationContractModel;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var AddressModel
     */
    private $addressModel;

    /**
     * @var EmergencyContactModel
     */
    private $emergencyContactModel;

    /**
     * @var EmployeeContractModel
     */
    private $employeeContractModel;

    /**
     * @var IContractRepository
     */
    private $contractRepository;

    /**
     * @var ContractExportService;
     */
    private $contractExportService;

    /**
     * @var IEmployeeContractRepository
     */
    private $employeeContractRepository;

    /**
     * @var IAvailabilityShiftService
     */
    private $availabilityShiftService;
    /**
     * @var IAvailabilityDateValidatorService
     */
    private $dateValidator;

    /**
     * @var string;
     */
    private $file;


    public function setUp(): void
    {
        parent::setUp();

//        $file = generatePdf(base64_encode('testtestesttest'));

//        $this->file = Storage::disk('local')->put(storage_path('contracts/' . $file . '.pdf'));


        $this->userModel = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getNmbrsId')
                ->andReturn(1);

            $mock->shouldReceive('getAlias')
                ->andReturn('rvw');

            $mock->shouldReceive('getInitials')
                ->andReturn('r');

            $mock->shouldReceive('getFirstName')
                ->andReturn('Ricky');

            $mock->shouldReceive('getInsertion')
                ->andReturn('van');

            $mock->shouldReceive('getLastname')
                ->andReturn('Waas');

            $mock->shouldReceive('getPhone')
                ->andReturn('061234567');

            $mock->shouldReceive('isHasDriversLicense')
                ->andReturn(true);

            $mock->shouldReceive('getDateOfBirth')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getCountryOfBirthId')
                ->andReturn(1);

            $mock->shouldReceive('getNationalityId')
                ->andReturn(1);

            $mock->shouldReceive('getMaritalStatusId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('2019-01-01');

            $mock->shouldReceive('getPassword')
                ->andReturn('123456');

            $mock->shouldReceive('isActive')
                ->andReturn(true);

            $mock->shouldReceive('getAddress')
                ->andReturn($this->addressModel);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn($this->emergencyContactModel);

            $mock->shouldReceive('setAddress')
                ->with(AddressModel::class)
                ->andReturn($mock);

            $mock->shouldReceive('setEmergencyContact')
                ->with(EmergencyContactModel::class)
                ->andReturn($mock);
        });

        $this->paginationContractModel = m::mock(PaginationContractModel::class, function ($mock) {
            $mock->shouldReceive('getStartDate')
                ->andReturn('2020-01-20');

            $mock->shouldReceive('getEndDate')
                ->andReturn('2020-01-20');

            $mock->shouldReceive('getEmployeeName')
                ->andReturn('Mohamed');

            $mock->shouldReceive('getEmployeeName')
                ->andReturn(10);
        });

        $this->employeeContractModel = m::mock(EmployeeContractModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getStartDate')
                ->andReturn('2020-01-20');

            $mock->shouldReceive('getEndDate')
                ->andReturn('2020-01-20');

            $mock->shouldReceive('getTrialPerDay')
                ->andReturn(20);

            $mock->shouldReceive('getUser')
                ->andReturn($this->userModel);

            $mock->shouldReceive('getDocumentNumber')
                ->andReturn(10);
        });


        $this->contractRepository = m::mock(IContractRepository::class, function ($mock) {
            $mock->shouldReceive('get')
                ->with(PaginationContractModel::class)
                ->andReturn(Collection::class);
        });


        $this->contractExportService = m::mock(ContractExportService::class, function ($mock) {
            $mock->shouldReceive('export')
                ->with($this->file)
                ->andReturn($this->file);
        });

        $this->employeeContractRepository = m::mock(IEmployeeContractRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(EmployeeContractModel::class)
                ->andReturn($this->employeeContractModel);

            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn($this->employeeContractModel);
        });

    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function testExportContract()
    {
        $service = new ContractService($this->contractRepository, $this->contractExportService, $this->employeeContractRepository);
//        $result = $service->export($this->employeeContractModel);
    }

}
