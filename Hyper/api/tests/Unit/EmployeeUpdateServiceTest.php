<?php

namespace Tests\Unit;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\Auth\UserNotFoundException;
use App\Exceptions\EmergencyContact\EmergencyContactNotFoundException;
use App\Exceptions\Employee\EmployeeAddressModelNotSetException;
use App\Exceptions\Employee\EmployeeEmergencyContactModelNotSetException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Employee\EmployeeUpdateService;
use App\User;
use Tests\TestCase;
use Mockery as m;

class EmployeeUpdateServiceTest extends TestCase
{
    /**
     * @var IUserRepository
     */
    private $userRepository;

    /**
     * @var IUserRepository
     */
    private $userNotFoundRepository;

    /**
     * @var IAddressRepository
     */
    private $addressRepository;

    /**
     * @var IAddressRepository
     */
    private $addressNotFoundRepository;

    /**
     * @var IEmergencyContactRepository
     */
    private $emergencyContactRepository;

    /**
     * @var IEmergencyContactRepository
     */
    private $emergencyContactNotFoundRepository;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var UserModel
     */
    private $userModelWithoutAddress;

    /**
     * @var UserModel
     */
    private $userModelWithInvalidAddressModel;

    /**
     * @var UserModel
     */
    private $userModelWithInvalidContactModel;

    /**
     * @var UserModel
     */
    private $userModelWithoutEmergencyContact;

    /**
     * @var UserModel
     */
    private $userModelWithoutAddressAndEmergencyContact;

    /**
     * @var AddressModel
     */
    private $addressModel;

    /**
     * @var AddressModel
     */
    private $invalidAddressModel;

    /**
     * @var EmergencyContactModel
     */
    private $emergencyContactModel;

    /**
     * @var EmergencyContactModel
     */
    private $invalidEmergencyContactModel;



    public function setUp(): void
    {
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

        $this->invalidAddressModel = m::mock(AddressModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getUser')
                ->andReturn(2);
        });
        $this->invalidEmergencyContactModel = m::mock(EmergencyContactModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getUser')
                ->andReturn(2);
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
        $this->userModelWithInvalidAddressModel = m::mock(UserModel::class, function ($mock) {
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
                ->andReturn($this->invalidAddressModel);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn($this->emergencyContactModel);

            $mock->shouldReceive('setAddress')
                ->with(AddressModel::class)
                ->andReturn($mock);

            $mock->shouldReceive('setEmergencyContact')
                ->with(EmergencyContactModel::class)
                ->andReturn($mock);
        });
        $this->userModelWithInvalidContactModel = m::mock(UserModel::class, function ($mock) {
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
                ->andReturn($this->invalidEmergencyContactModel);

            $mock->shouldReceive('setAddress')
                ->with(AddressModel::class)
                ->andReturn($mock);

            $mock->shouldReceive('setEmergencyContact')
                ->with(EmergencyContactModel::class)
                ->andReturn($mock);
        });
        $this->userModelWithoutAddress = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getAddress')
                ->andReturn(null);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn($this->emergencyContactModel);
        });
        $this->userModelWithoutEmergencyContact = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getAddress')
                ->andReturn($this->addressModel);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn(null);
        });
        $this->userModelWithoutAddressAndEmergencyContact = m::mock(UserModel::class, function ($mock) {
            $mock->shouldReceive('getAddress')
                ->andReturn(null);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn(null);
        });

        $this->userRepository = m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->userModel);

            $mock->shouldReceive('update')
                ->with(1, UserModel::class)
                ->andReturn($this->userModel);
        });
        $this->userNotFoundRepository = m::mock(IUserRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(null);
        });
        $this->addressRepository = m::mock(IAddressRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->addressModel);

            $mock->shouldReceive('update')
                ->with(1, AddressModel::class)
                ->andReturn($this->addressModel);
        });
        $this->addressNotFoundRepository = m::mock(IAddressRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(null);
        });
        $this->emergencyContactRepository = m::mock(IEmergencyContactRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn($this->emergencyContactModel);

            $mock->shouldReceive('update')
                ->with(1, EmergencyContactModel::class)
                ->andReturn($this->emergencyContactModel);
        });
        $this->emergencyContactNotFoundRepository = m::mock(IEmergencyContactRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->with(1)
                ->andReturn(null);
        });

        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testNewEmployeeUpdateWithoutAddressModelAndEmergencyContactModel()
    {
        $this->expectException(EmployeeAddressModelNotSetException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModelWithoutAddressAndEmergencyContact);
    }

    public function testNewEmployeeUpdateWithoutAddressModel()
    {
        $this->expectException(EmployeeAddressModelNotSetException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModelWithoutAddress);
    }

    public function testNewEmployeeUpdateWithoutEmergencyContactModel()
    {
        $this->expectException(EmployeeEmergencyContactModelNotSetException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModelWithoutEmergencyContact);
    }

    public function testNewEmployeeUpdateWithNotFoundUser()
    {
        $this->expectException(EmployeeNotFoundException::class);

        $service = new EmployeeUpdateService(
            $this->userNotFoundRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModel);
    }

    public function testNewEmployeeUpdateWithNotFoundAddress()
    {
        $this->expectException(AddressNotFoundException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressNotFoundRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModel);
    }

    public function testNewEmployeeUpdateWithNotFoundEmergencyContact()
    {
        $this->expectException(EmergencyContactNotFoundException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactNotFoundRepository
        );
        $service->update(1, $this->userModel);
    }

    public function testNewEmployeeUpdateWithInvalidAddress()
    {
//        $this->expectException(AddressNotFoundException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModelWithInvalidAddressModel);
    }

    public function testNewEmployeeUpdateWithInvalidEmergencyContact()
    {
//        $this->expectException(EmergencyContactNotFoundException::class);

        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModelWithInvalidContactModel);
    }

    public function testNewEmployeeUpdate()
    {
        $service = new EmployeeUpdateService(
            $this->userRepository,
            $this->addressRepository,
            $this->emergencyContactRepository
        );
        $service->update(1, $this->userModel);
    }

}
