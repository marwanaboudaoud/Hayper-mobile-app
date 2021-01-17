<?php


namespace App\Src\Services\Hyper\Employee;

use App\Exceptions\Employee\EmployeeEmailAlreadyExistsException;
use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Token\ITokenService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements IEmployeeService
{
    /**
     * @var IUserRepository
     */
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param  $id
     * @return UserModel
     * @throws EmployeeNotFoundException
     */
    public function find($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new EmployeeNotFoundException();
        }

        return $user;
    }

    /**
     * @param PaginationEmployeeModel $paginationModel
     * @return PaginationModel
     */
    public function get(PaginationEmployeeModel $paginationModel)
    {
        return $this->userRepository->get($paginationModel);
    }
}
