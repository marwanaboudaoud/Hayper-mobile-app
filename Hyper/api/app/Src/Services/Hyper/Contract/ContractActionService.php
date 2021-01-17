<?php


namespace App\Src\Services\Hyper\Contract;

use App\Exceptions\Contract\ContractCannotExtendedException;
use App\Src\Models\Hyper\Contract\EmployeeContractActionModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractActionRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractDeleteRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Employee\IEmployeeUpdateService;
use Illuminate\Support\Carbon;

class ContractActionService implements IContractActionService
{
    /**
     * @var IContractService
     */
    private $contractService;

    /**
     * @var ContractStoreService
     */
    private $contractStoreService;

    /**
     * @var IEmployeeContractActionRepository
     */
    private $contractActionRepository;

    /**
     * @var IEmployeeContractDeleteRepository
     */
    private $contractDeleteRepository;

    /**
     * @var IEmployeeService
     */
    private $employeeService;

    /**
     * @var IEmployeeUpdateService
     */
    private $employeeUpdateService;

    /**
     * @var IEmployeeContractRepository
     */
    private $employeeContractRepository;

    /**
     * ContractActionService constructor.
     * @param IContractService $contractService
     * @param IContractStoreService $contractStoreService
     * @param IEmployeeContractActionRepository $contractActionRepository
     * @param IEmployeeContractDeleteRepository $contractDeleteRepository
     * @param IEmployeeService $employeeService
     * @param IEmployeeUpdateService $employeeUpdateService
     * @param IEmployeeContractRepository $employeeContractRepository
     */
    public function __construct(
        IContractService $contractService,
        IContractStoreService $contractStoreService,
        IEmployeeContractActionRepository $contractActionRepository,
        IEmployeeContractDeleteRepository $contractDeleteRepository,
        IEmployeeService $employeeService,
        IEmployeeUpdateService $employeeUpdateService,
        IEmployeeContractRepository $employeeContractRepository
    ) {
        $this->contractService = $contractService;
        $this->contractStoreService = $contractStoreService;
        $this->contractActionRepository = $contractActionRepository;
        $this->contractDeleteRepository = $contractDeleteRepository;
        $this->employeeService = $employeeService;
        $this->employeeUpdateService = $employeeUpdateService;
        $this->employeeContractRepository = $employeeContractRepository;
    }

    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @return bool
     * @throws \Exception
     */
    public function createOrDelete(EmployeeContractActionModel $contractActionModel)
    {
        $oldContractModel = $this->contractService->find($contractActionModel->getOldContractId());

        if (!$contractActionModel->isExtended()) {
            return $this->delete($oldContractModel);
        }

        $countContracts = $this->contractService->findByUserId($oldContractModel->getUserId())->count();
        $maxContracts = 2;

        if ($countContracts > $maxContracts) {
            throw new ContractCannotExtendedException();
        }

        return $this->extendCurrentContract($contractActionModel, $oldContractModel);
    }

    /**
     * @param EmployeeContractActionModel $contractActionModel
     * @param EmployeeContractModel $oldContractModel
     * @return mixed|void
     * @throws \Exception
     */
    public function extendCurrentContract(
        EmployeeContractActionModel $contractActionModel,
        EmployeeContractModel $oldContractModel
    ) {
        $newContractModel = clone $oldContractModel;
        $newContractModel->setStartDate(Carbon::parse($oldContractModel->getEndDate())->addDays());
        $newContractModel->setEndDate(Carbon::parse($newContractModel->getStartDate())->addMonths(11));

        $contractActionModel->setOldContractId($oldContractModel->getId());

        $newContract = $this->contractStoreService->store($newContractModel);
        $this->employeeUpdateService->updateExpireDate($newContract->getUserId(), $newContract->getEndDate());

        $contractActionModel->setNewContractId($newContract->getId());

        $this->contractActionRepository->store($contractActionModel);

        $this->generateContract($newContract->getUserId());

        return true;
    }

    protected function generateContract(int $userId)
    {
        $employee = $this->employeeService->find($userId);

        $this->contractService->generatePdf($employee);
    }

    /**
     * @param EmployeeContractModel $contractModel
     * @return bool|mixed
     * @throws \Exception
     */
    public function delete(EmployeeContractModel $contractModel)
    {
        $contractId = $contractModel->getId();
        $userId = $contractModel->getUser()->getId();

        $this->contractDeleteRepository->delete($contractId);

        $foundUser = $this->employeeService->find($userId);
        $updatedUser = $foundUser->setEndDateContract($contractModel->getEndDate());
        $this->employeeUpdateService->update($userId, $updatedUser);

        return false;
    }
}
