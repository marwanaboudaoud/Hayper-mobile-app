<?php


namespace App\Src\Repositories\Nmbrs\Employee;

use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Repositories\Nmbrs\NmbrsRepository;

class EmployeeStoreRepository extends NmbrsRepository implements IEmployeeStoreRepository
{
    /**
     * @var IEmployeeUpdateRepository
     */
    protected $employeeUpdateRepository;

    protected $userRepository;

    public function __construct(IEmployeeUpdateRepository $employeeUpdateRepository, IUserRepository $userRepository)
    {
        $this->employeeUpdateRepository = $employeeUpdateRepository;
        $this->userRepository = $userRepository;

        parent::__construct('EmployeeService');
    }

    public function store(UserModel $userModel)
    {
        $result = $this->client->Employee_Insert(
            [
                'FirstName' => $userModel->getFirstName(),
                'LastName' => $userModel->getLastName(),
                'StartDate' => '2019-01-01',
                'CompanyId' => \env('NMBRS_COMPANY_ID'),
                'UnprotectedMode' => true,
            ]
        );

        $userModel->setNmbrsId($result->Employee_InsertResult);
        $this->employeeUpdateRepository->update($userModel);
        $this->userRepository->update($userModel->getId(), $userModel);
    }
}
