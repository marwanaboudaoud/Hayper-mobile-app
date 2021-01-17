<?php


namespace App\Src\Services\Nmbrs\Employee;

use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Nmbrs\Employee\IEmployeeStoreRepository;
use App\Src\Services\Hyper\Employee\IEmployeeStoreService;

class EmployeeStoreNmbrsService implements IEmployeeStoreNmbrsService
{
    /**
     * @var IEmployeeStoreRepository
     */
    protected $employeeStoreNmbrseRepository;

    public function __construct(IEmployeeStoreRepository $employeeStoreNmbrsService)
    {
        $this->employeeStoreNmbrseRepository = $employeeStoreNmbrsService;
    }

    public function store(UserModel $userModel)
    {
        $this->employeeStoreNmbrseRepository->store($userModel);
    }
}
