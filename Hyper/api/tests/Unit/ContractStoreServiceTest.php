<?php


namespace Tests\Unit;


use App\Exceptions\Auth\UserNotFoundException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Contract\ContractStoreService;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Employee\IEmployeeUpdateService;
use Carbon\Carbon;
use Mockery as m;
use Tests\TestCase;

class ContractStoreServiceTest extends TestCase
{
    /**
     * @var IAddressRepository
     */
    private $addressRepository;
    /**
     * @var EmergencyContactModel
     */
    private $emergencyContactModel;

    /**
     * @var IEmployeeContractRepository
     */
    private $contractRepository;

    /**
     * @var IEmployeeService
     */
    private $employeeService;

    /**
     * @var IEmployeeService
     */
    private $employeeServiceNotFound;

    /**
     * @var EmployeeContractModel
     */
    private $contractModel;

    /**
     * @var UserModel
     */
    private $userModel;

    private $now;

    public function setUp(): void
    {
        $this->now = Carbon::now();

        $this->addressModel = m::mock(AddressModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getUser')
                ->andReturn(1);
        });
        $this->emergencyContactModel = m::mock(EmergencyContactModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getUser')
                ->andReturn(1);
        });
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
        $this->contractModel = m::mock(EmployeeContractModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getStartDate')
                ->andReturn('21-10-2020');

            $mock->shouldReceive('getEndDate')
                ->andReturn($this->now);

            $mock->shouldReceive('getTrialPerDay')
                ->andReturn(11);

            $mock->shouldReceive('getUser')
                ->andReturn(1);

            $mock->shouldReceive('getUserId')
                ->andReturn(1);

        });

        $this->contractRepository = m::mock(IEmployeeContractRepository::class, function ($mock) {
            $mock->shouldReceive('store')
                ->with(EmployeeContractModel::class)
                ->andReturn($this->contractModel);
        });

        $this->userNotFoundRepository = m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(null);
        });


        $this->employeeService = m::mock(IEmployeeUpdateService::class, function ($mock) {
            $mock->shouldReceive('updateExpireDate')
                ->with(1, $this->now)
                ->andReturn($this->userModel);
        });

        $this->employeeServiceNotFound = m::mock(IEmployeeUpdateService::class, function ($mock) {
            $mock->shouldReceive('find')
                ->with(1)
                ->andReturn(new UserNotFoundException());

            $mock->shouldReceive('updateExpireDate')
                ->with(1, $this->now)
                ->andReturn($this->userModel);
        });
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testStoreContract()
    {
        $service = new ContractStoreService($this->contractRepository, $this->employeeService);
        $service->store($this->contractModel);
    }

    public function testNoEmployeeFoundOnContractStore()
    {
        $service = new ContractStoreService($this->contractRepository, $this->employeeServiceNotFound);
        $service->store($this->contractModel);
    }
}
