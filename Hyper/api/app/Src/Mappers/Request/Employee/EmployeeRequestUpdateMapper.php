<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Src\Models\Hyper\User\UserModel;

class EmployeeRequestUpdateMapper
{
    public static function toUserModel(EmployeeUpdateRequest $employeeUpdateRequest)
    {
        $address = $employeeUpdateRequest->address;
        $emergencyContact = $employeeUpdateRequest->emergency_contact;

        if ($address) {
            $address = json_decode(json_encode($address));
            $address = EmployeeAddressRequestUpdateMapper::toAddressModel($address);
        }

        if ($emergencyContact) {
            $emergencyContact = json_decode(json_encode($emergencyContact));
            $emergencyContact = EmployeeEmergencyContactRequestUpdateMapper::toEmergencyContactModel($emergencyContact);
        }

        return (new UserModel())
            ->setNmbrsId($employeeUpdateRequest->nmbrs_id)
            ->setAlias($employeeUpdateRequest->alias)
            ->setInitials($employeeUpdateRequest->initials)
            ->setGenderId($employeeUpdateRequest->gender)
            ->setFirstName($employeeUpdateRequest->first_name)
            ->setInsertion($employeeUpdateRequest->insertion)
            ->setLastName($employeeUpdateRequest->last_name)
            ->setPhone($employeeUpdateRequest->phone)
            ->setHasDriversLicense($employeeUpdateRequest->has_drivers_license)
            ->setDateOfBirth($employeeUpdateRequest->date_of_birth)
            ->setCountryOfBirthId($employeeUpdateRequest->country_of_birth_id)
            ->setNationalityId($employeeUpdateRequest->nationality_id)
            ->setMaritalStatusId($employeeUpdateRequest->marital_status_id)
            ->setEmail($employeeUpdateRequest->email)
            ->setPassword($employeeUpdateRequest->password)
            ->setRoleId($employeeUpdateRequest->role_id)
            ->setGenderId($employeeUpdateRequest->gender_id)
            ->setIban($employeeUpdateRequest->iban)
            ->setIncomeTax($employeeUpdateRequest->income_tax)
            ->setAddress($address)
            ->setEmergencyContact($emergencyContact)
            ->setWorkOnProject(collect($employeeUpdateRequest->works_on_project));
    }
}
