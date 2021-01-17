<?php


namespace App\Src\Services\Hyper\Contract;

use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Employee\EmployeeUpdateService;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Employee\IEmployeeUpdateService;

class ContractStoreService implements IContractStoreService
{
    /**
     * @var IEmployeeContractRepository
     */
    protected $contractRepository;

    /**
     * @var EmployeeUpdateService
     */
    protected $employeeUpdateService;

    /**
     * ContractStoreService constructor.
     * @param IEmployeeContractRepository $contractRepository
     * @param IEmployeeUpdateService $employeeUpdateService
     */
    public function __construct(
        IEmployeeContractRepository $contractRepository,
        IEmployeeUpdateService $employeeUpdateService
    ) {
        $this->contractRepository = $contractRepository;
        $this->employeeUpdateService = $employeeUpdateService;
    }

    /**
     * @param EmployeeContractModel $employeeContractModel
     * @return EmployeeContractModel
     */
    public function store(EmployeeContractModel $employeeContractModel)
    {
        $this->employeeUpdateService->updateExpireDate(
            $employeeContractModel->getUserId(),
            $employeeContractModel->getEndDate()
        );

        return $this->contractRepository->store($employeeContractModel);
    }
}
