<?php


namespace Tests\Unit\Mappers\Request;


use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Mappers\Request\Employee\EmployeeEmergencyContactRequestStoreMapper;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use Tests\TestCase;

class EmployeeEmergencyContactRequestMapperTest extends TestCase
{
    public function testToModel()
    {
        $emergencyContact = new \stdClass();
        $emergencyContact->first_name = 'Niemand';
        $emergencyContact->last_name = 'Niemand';
        $emergencyContact->phone = '112';
        $emergencyContact->relationship = 'plitie';

        $emergencyContact = EmployeeEmergencyContactRequestStoreMapper::toEmergencyContactModel($emergencyContact);

        $this->assertInstanceOf(EmergencyContactModel::class, $emergencyContact);

        $this->assertEquals('Niemand', $emergencyContact->getFirstName());
        $this->assertEquals('Niemand', $emergencyContact->getLastName());
        $this->assertEquals('112', $emergencyContact->getPhone());
        $this->assertEquals('plitie', $emergencyContact->getRelationship());
    }
}
