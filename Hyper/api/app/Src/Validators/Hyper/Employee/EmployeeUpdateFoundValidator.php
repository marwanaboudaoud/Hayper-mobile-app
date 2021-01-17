<?php


namespace App\Src\Validators\Hyper\Employee;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\EmergencyContact\EmergencyContactNotFoundException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\User\UserModel;

class EmployeeUpdateFoundValidator
{
    /**
     * @param  UserModel|null        $user
     * @param  AddressModel          $address
     * @param  EmergencyContactModel $emergencyContact
     * @throws AddressNotFoundException
     * @throws EmergencyContactNotFoundException
     * @throws EmployeeNotFoundException
     */
    public static function validate(?UserModel $user, ?AddressModel $address, ?EmergencyContactModel $emergencyContact)
    {
        if (!$user) {
            throw new EmployeeNotFoundException();
        }

        if (!$address) {
            throw new AddressNotFoundException();
        }

        if (!$emergencyContact) {
            throw new EmergencyContactNotFoundException();
        }

        if ($user->getId() !== $address->getUser()) {
            throw new AddressNotFoundException();
        }

        if ($user->getId() !== $emergencyContact->getUser()) {
            throw new EmergencyContactNotFoundException();
        }
    }
}
