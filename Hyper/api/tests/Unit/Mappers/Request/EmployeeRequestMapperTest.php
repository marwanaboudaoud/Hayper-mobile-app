<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Mappers\Request\Employee\EmployeeAddressRequestStoreMapper;
use App\Src\Mappers\Request\Employee\EmployeeEmergencyContactRequestStoreMapper;
use App\Src\Mappers\Request\Employee\EmployeeRequestMapper;
use App\Src\Mappers\Request\Employee\EmployeeRequestStoreMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\User\UserModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $request = new EmployeeStoreRequest();
        $request->merge([
            'alias' => 'abc',
            'initials' => 'rvw',
            'first_name' => 'Ricky',
            'insertion' => 'van',
            'last_name' => 'Waas',
            'phone' => '061234567',
            'has_drivers_license' => true,
            'date_of_birth' => '1995-05-04',
            'country_of_birth_id' => 1,
            'nationality_id' => 2,
            'marital_status_id' => 3,
            'email' => 'ricky@holygrow.nl',
            'password' => '123456',
            'role_id' => 2,
        ]);

        $addressClass = new \stdClass();
        $addressClass->street = 'jol';
        $addressClass->house_number = '38';
        $addressClass->addition = '35';
        $addressClass->postcode = '8224 cp';
        $addressClass->city = 'Lelystad';

        $emergencyClass = new \stdClass();
        $emergencyClass->first_name = 'Niemand';
        $emergencyClass->last_name = 'Niemand';
        $emergencyClass->phone = '112';
        $emergencyClass->relationship = 'plitie';

        $employee = EmployeeRequestStoreMapper::toUserModel($request);
        $address = EmployeeAddressRequestStoreMapper::toAddressModel($addressClass);
        $emergencyContact = EmployeeEmergencyContactRequestStoreMapper::toEmergencyContactModel($emergencyClass);

        $this->assertInstanceOf(UserModel::class, $employee);
        $this->assertInstanceOf(AddressModel::class, $address);
        $this->assertInstanceOf(EmergencyContactModel::class, $emergencyContact);
        $this->assertEquals('abc', $employee->getAlias());
//        $this->assertEquals('12345', $employee->getNmbrsId());
        $this->assertEquals('rvw', $employee->getInitials());
        $this->assertEquals('Ricky', $employee->getFirstName());
        $this->assertEquals('van', $employee->getInsertion());
        $this->assertEquals('Waas', $employee->getLastName());
        $this->assertEquals('061234567', $employee->getPhone());
        $this->assertEquals(true, $employee->isHasDriversLicense());
        $this->assertEquals('1995-05-04', $employee->getDateOfBirth());
//        $this->assertEquals(1, $employee->getCountryOfBirthId());
//        $this->assertEquals(2, $employee->getNationalityId());
//        $this->assertEquals(3, $employee->getMaritalStatusId());
        $this->assertEquals('ricky@holygrow.nl', $employee->getEmail());
        $this->assertEquals('123456', $employee->getPassword());
        $this->assertEquals(2, $employee->getRoleId());
        $this->assertEquals('jol', $address->getStreet());
        $this->assertEquals('38', $address->getHouseNumber());
        $this->assertEquals('35', $address->getAddition());
        $this->assertEquals('Lelystad', $address->getCity());
        $this->assertEquals('8224 cp', $address->getPostcode());

        $this->assertEquals('Niemand', $emergencyContact->getFirstName());
        $this->assertEquals('Niemand', $emergencyContact->getLastName());
        $this->assertEquals('112', $emergencyContact->getPhone());
        $this->assertEquals('plitie', $emergencyContact->getRelationship());

    }

    public function testValidationRules()
    {
        $request = new EmployeeStoreRequest();

        $this->assertEquals([
            'alias' => 'required|string',
            'initials' => 'required|string',
            'first_name' => 'required|string',
            'insertion' => 'string|nullable',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'gender_id' => 'required|int',
            'has_drivers_license' => 'required|bool',
            'date_of_birth' => 'date',
            'country_of_birth_id' => 'required|int',
            'nationality_id' => 'required|int',
            'marital_status_id' => 'required|int',
            'bsn' => 'required|int',
            'iban' => 'required|string',
            'income_tax' => 'required|bool',
            'role_id' => 'required|int',
            'address.street' => 'required|string',
            'address.house_number' => 'required|int',
            'address.house_number_addition' => 'string',
            'address.postcode' => 'required|string',
            'address.city' => 'required|string',
            'emergency_contact.first_name' => 'required|string',
            'emergency_contact.last_name' => 'required|string',
            'emergency_contact.phone' => 'required|string',
            'emergency_contact.relationship' => 'required|string',
            'works_on_project' => 'array',
            'contract.start_date' => 'required|date_format:"Y-m-d"',
            'contract.end_date' => 'date_format:"Y-m-d"',
            'contract.trial_per_day' => 'required|int',
            'contract.document_number' => 'required|string',
        ], $request->rules());
    }
}
