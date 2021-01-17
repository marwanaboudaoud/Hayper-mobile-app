<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;

class EmployeeEmergencyContactRequestStoreMapper
{
    public static function toEmergencyContactModel(\stdClass $employeeRequest)
    {
        return (new EmergencyContactModel())
            ->setFirstName(
                propExistOrNull($employeeRequest, 'first_name')
            )
            ->setLastName(
                propExistOrNull($employeeRequest, 'last_name')
            )
            ->setPhone(
                propExistOrNull($employeeRequest, 'phone')
            )
            ->setRelationship(
                propExistOrNull($employeeRequest, 'relationship')
            );
    }
}
