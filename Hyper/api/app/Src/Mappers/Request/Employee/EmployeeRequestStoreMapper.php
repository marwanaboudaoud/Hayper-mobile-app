<?php


namespace App\Src\Mappers\Request\Employee;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Src\Models\Hyper\User\UserModel;

class EmployeeRequestStoreMapper
{
    public static function toUserModel(EmployeeStoreRequest $employeeRequest)
    {
        $contract = $employeeRequest->contract;

        $address = $employeeRequest->address;
        $emergencyContact = $employeeRequest->emergency_contact;

        if ($address) {
            $address = json_decode(json_encode($address));
            $address = EmployeeAddressRequestStoreMapper::toAddressModel($address);
        }

        if ($contract) {
            $contract = json_decode(json_encode($contract));
            $contract = ContractRequestStoreMapper::toEmployeeContractModel($contract);
        }

        if ($emergencyContact) {
            $emergencyContact = json_decode(json_encode($emergencyContact));
            $emergencyContact = EmployeeEmergencyContactRequestStoreMapper::toEmergencyContactModel($emergencyContact);
        }

        return (new UserModel())
            ->setNmbrsId($employeeRequest->nmbrs_id)
            ->setAlias($employeeRequest->alias)
            ->setInitials($employeeRequest->initials)
            ->setGenderId($employeeRequest->gender_id)
            ->setFirstName($employeeRequest->first_name)
            ->setInsertion($employeeRequest->insertion)
            ->setLastName($employeeRequest->last_name)
            ->setPhone($employeeRequest->phone)
            ->setHasDriversLicense($employeeRequest->has_drivers_license)
            ->setDateOfBirth($employeeRequest->date_of_birth)
            ->setCountryOfBirthId($employeeRequest->country_of_birth_id)
            ->setNationalityId($employeeRequest->nationality_id)
            ->setMaritalStatusId($employeeRequest->marital_status_id)
            ->setBsn($employeeRequest->bsn)
            ->setIban($employeeRequest->iban)
            ->setIncomeTax($employeeRequest->income_tax)
            ->setEmail($employeeRequest->email)
            ->setPassword($employeeRequest->password)
            ->setRoleId($employeeRequest->role_id)
            ->setAddress($address)
            ->setEmergencyContact($emergencyContact)
            ->setWorkOnProject(collect($employeeRequest->works_on_project))
            ->setEmployeeContract($contract);
    }
}
