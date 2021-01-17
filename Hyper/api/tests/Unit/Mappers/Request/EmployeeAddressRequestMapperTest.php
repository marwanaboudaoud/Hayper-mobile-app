<?php


namespace Tests\Unit\Mappers\Request;


use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Mappers\Request\Employee\EmployeeAddressRequestStoreMapper;
use App\Src\Mappers\Request\Employee\EmployeeEmergencyContactRequestStoreMapper;
use App\Src\Mappers\Request\Employee\EmployeeRequestStoreMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\User\UserModel;
use Tests\TestCase;
use function Matrix\add;

class EmployeeAddressRequestMapperTest extends TestCase
{
    public function testToModel()
    {
        $addressClass = new \stdClass();
        $addressClass->street = 'jol';
        $addressClass->house_number = '38';
        $addressClass->addition = '35';
        $addressClass->city = 'Lelystad';
        $addressClass->postcode = '8224 cp';

        $address = EmployeeAddressRequestStoreMapper::toAddressModel($addressClass);

        $this->assertInstanceOf(AddressModel::class, $address);
        $this->assertEquals('jol', $address->getStreet());
        $this->assertEquals('38', $address->getHouseNumber());
        $this->assertEquals('35', $address->getAddition());
        $this->assertEquals('Lelystad', $address->getCity());
        $this->assertEquals('8224 cp', $address->getPostcode());
    }
}
