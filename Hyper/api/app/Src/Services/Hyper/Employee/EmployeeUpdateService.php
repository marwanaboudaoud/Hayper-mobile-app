<?php


namespace App\Src\Services\Hyper\Employee;

use App\Exceptions\Address\AddressNotFoundException;
use App\Exceptions\EmergencyContact\EmergencyContactNotFoundException;
use App\Exceptions\Employee\EmployeeAddressModelNotSetException;
use App\Exceptions\Employee\EmployeeEmergencyContactModelNotSetException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Mappers\Hyper\Address\AddressModelMapper;
use App\Src\Mappers\Hyper\EmergencyContact\EmergencyContactModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Validators\Hyper\Employee\EmployeeUpdateFoundValidator;
use App\Src\Validators\Hyper\Employee\EmployeeUpdateModelValidator;
use Carbon\Carbon;

class EmployeeUpdateService implements IEmployeeUpdateService
{
    /**
     * @var IUserRepository
     */
    protected $userRepository;

    /**
     * @var IAddressRepository
     */
    protected $addressRepository;

    /**
     * @var IEmergencyContactRepository
     */
    private $emergencyContactRepository;

    public function __construct(
        IUserRepository $userRepository,
        IAddressRepository $addressRepository,
        IEmergencyContactRepository $emergencyContactRepository
    ) {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->emergencyContactRepository = $emergencyContactRepository;
    }

    /**
     * @param  int       $id
     * @param  UserModel $userModel
     * @return mixed
     * @throws EmployeeAddressModelNotSetException
     * @throws EmployeeEmergencyContactModelNotSetException
     * @throws EmployeeNotFoundException
     * @throws AddressNotFoundException
     * @throws EmergencyContactNotFoundException
     */
    public function update(int $id, UserModel $userModel)
    {
        EmployeeUpdateModelValidator::validate($userModel);

        $foundUser = $this->userRepository->findById($id);
        $foundAddress = $this->addressRepository->findById($userModel->getAddress()->getId());
        $foundEmergencyContact = $this->emergencyContactRepository->findById(
            $userModel->getEmergencyContact()->getId()
        );

        EmployeeUpdateFoundValidator::validate($foundUser, $foundAddress, $foundEmergencyContact);

        $updatedUser = $this->userRepository->update($id, $userModel);
        $updatedAddress = $this->addressRepository->update($userModel->getAddress()->getId(), $userModel->getAddress());
        $updatedEmergencyContact = $this->emergencyContactRepository->update(
            $userModel->getEmergencyContact()->getId(),
            $userModel->getEmergencyContact()
        );

        $updatedUser->setAddress($updatedAddress)->setEmergencyContact($updatedEmergencyContact);

        return $updatedUser;
    }

    /**
     * @inheritDoc
     */
    public function updateExpireDate(int $id, ?Carbon $outOfService)
    {
        $foundUser = $this->userRepository->findById($id);
        $foundUser->setOutOfService($outOfService);

        return $this->userRepository->update($id, $foundUser);
    }
}
