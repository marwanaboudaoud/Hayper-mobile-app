<?php


namespace App\Src\Validators\Hyper\Employee;

use App\Exceptions\Employee\EmployeeAddressModelNotSetException;
use App\Exceptions\Employee\EmployeeEmergencyContactModelNotSetException;
use App\Src\Models\Hyper\User\UserModel;

class EmployeeUpdateModelValidator
{
    /**
     * @param  UserModel $userModel
     * @throws EmployeeAddressModelNotSetException
     * @throws EmployeeEmergencyContactModelNotSetException
     */
    public static function validate(UserModel $userModel)
    {
        $addressModel = $userModel->getAddress();
        $emergencyContactModel = $userModel->getEmergencyContact();

        if (!$addressModel) {
            throw new EmployeeAddressModelNotSetException();
        }

        if (!$emergencyContactModel) {
            throw new EmployeeEmergencyContactModelNotSetException();
        }
    }
}
