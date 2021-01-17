<?php


namespace App\Src\Repositories\Nmbrs\Employee;

use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Nmbrs\NmbrsRepository;

class EmployeeUpdateRepository extends NmbrsRepository implements IEmployeeUpdateRepository
{
    public function __construct()
    {
        parent::__construct('EmployeeService');
    }

    public function update(UserModel $userModel)
    {
        $this->client->PersonalInfo_UpdateCurrent(
            [
                'EmployeeId' => $userModel->getNmbrsId(),
                'PersonalInfo' => [
                    'Id' => $userModel->getNmbrsId(),
                    'Number' => 1,
                    'EmployeeNumber' => $userModel->getNmbrsId(),
                    'BSN' => '',
                    'Title' => '',
                    'FirstName' => $userModel->getFirstName(),
                    'Initials' => $userModel->getInitials(),
                    'Prefix' => $userModel->getInsertion(),
                    'LastName' => $userModel->getLastName(),
                    'Nickname' => '',
                    'Gender' => 'male',
                    'NationalityCode' => '',
                    'PlaceOfBirth' => '',
                    'CountryOfBirthISOCode' => '',
                    'IdentificationNumber' => '',
                    'IdentificationType' => '1',
                    'PartnerPrefix' => '',
                    'PartnerLastName' => '',
                    'TelephonePrivate' => $userModel->getPhone(),
                    'TelephoneWork' => '',
                    'TelephoneMobilePrivate' => '',
                    'TelephoneMobileWork' => '',
                    'TelephoneOther' => '',
                    'EmailPrivate' => $userModel->getEmail(),
                    'EmailWork' => '',
                    'Naamstelling' => '',
                    'Birthday' => $userModel->getDateOfBirth(),
                    'InCaseOfEmergencyPhone' => '',
                    'InCaseOfEmergencyRelation' => '',
                    'TitleAfter' => '',
                ]
            ]
        );
    }
}
