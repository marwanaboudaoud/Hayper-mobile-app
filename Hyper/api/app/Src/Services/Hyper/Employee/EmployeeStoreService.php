<?php


namespace App\Src\Services\Hyper\Employee;

use App\Exceptions\Employee\EmployeeEmailAlreadyExistsException;
use App\Exceptions\Role\RoleNotFoundException;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\EmergencyContact\EmergencyContactModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Models\Hyper\Token\ActivateUserTokenModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\App\Financial\IFinancialOpenRepository;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\Role\IRoleRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractOnePdfGenerator;
use App\Src\Services\App\FinancialOpening\IFinancialOpenService;
use App\Src\Services\Hyper\Contract\ContractStoreService;
use App\Src\Services\Hyper\Contract\IContractService;
use App\Src\Services\Hyper\Contract\IContractStoreService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Token\ITokenService;
use App\Src\Services\Nmbrs\Employee\IEmployeeStoreNmbrsService;
use Carbon\Carbon;

class EmployeeStoreService implements IEmployeeStoreService
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
    protected $emergencyContactRepository;
    /**
     * @var ITokenService
     */
    private $activateUserService;

    /**
     * @var IEmployeeStoreNotifyService
     */
    private $notifyService;

    /**
     * @var IEmployeeStoreService
     */
    private $employeeStoreNmbrsService;

    /**
     * @var IContractStoreService
     */
    private $contractStoreService;

    /**
     * @var IRoleRepository
     */
    private $roleRepository;

    /**
     * @var IContractService
     */
    private $contractService;

    /**
     * @var IFinancialOpenService
     */
    private $financialOpenService;

    /**
     * @var int
     */
    private $id;

    public function __construct(
        IUserRepository $userRepository,
        IAddressRepository $addressRepository,
        IEmergencyContactRepository $emergencyContactRepository,
        ITokenService $activateUserService,
        IEmployeeStoreNotifyService $notifyService,
        IEmployeeStoreNmbrsService $employeeStoreNmbrsService,
        ContractStoreService $contractStoreService,
        IRoleRepository $roleRepository,
        IContractService $contractService,
        IFinancialOpenService $financialOpenService
    ) {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
        $this->emergencyContactRepository = $emergencyContactRepository;
        $this->activateUserService = $activateUserService;
        $this->notifyService = $notifyService;
        $this->employeeStoreNmbrsService = $employeeStoreNmbrsService;
        $this->contractStoreService = $contractStoreService;
        $this->roleRepository = $roleRepository;
        $this->contractService = $contractService;
        $this->financialOpenService = $financialOpenService;
    }

    public function store(UserModel $userModel)
    {
        $userModel->setActive(false);

        $existingUser = $this->userRepository->findByEmail($userModel->getEmail());
        $foundRole = $this->roleRepository->findById($userModel->getRoleId());

        if ($existingUser) {
            throw new EmployeeEmailAlreadyExistsException();
        }

        if (!$foundRole || $foundRole->getTitle() === 'Admin') {
            throw new RoleNotFoundException();
        }

        $newUser = $this->userRepository->store($userModel);
        $this->id = $newUser->getId();

//        $this->storeNmbrsx($userModel);
        $this->storeAddress($userModel->getAddress());
        $this->storeEmergencyContact($userModel->getEmergencyContact());
        $this->storeContract($userModel->getEmployeeContract());
        $token = $this->generateActivateToken($newUser);
        $this->generatePdf($newUser);
        $this->sendNotify($newUser, $token);

        $startSalary = Carbon::now();
        $salaryModel = (new SalaryModel())->setEmployee($newUser)
            ->setDate($startSalary)
            ->setHeading('Salary init')
            ->setDescription('First salary month')
            ->setClosed(false);
        $this->openSalary($salaryModel);

        return $newUser;
    }

    protected function storeNmbrs(UserModel $userModel)
    {
        $userModel->setId($this->id);
        return $this->employeeStoreNmbrsService->store($userModel);
    }

    protected function storeAddress(AddressModel $address)
    {
        $address->setUser($this->id)->setActive(true);
        return $this->addressRepository->store($address);
    }

    protected function storeEmergencyContact(EmergencyContactModel $contactModel)
    {
        $contactModel->setUser($this->id);
        return $this->emergencyContactRepository->store($contactModel);
    }

    protected function storeContract(EmployeeContractModel $contractModel)
    {
        $contractModel->setUserId($this->id);
        return $this->contractStoreService->store($contractModel);
    }

    protected function generateActivateToken(UserModel $userModel)
    {
        return $this->activateUserService->generate($userModel);
    }

    protected function generatePdf(UserModel $userModel)
    {
        $user = $this->userRepository->findById($userModel->getId());
        $this->contractService->generatePdf($user->setBsn(1));
    }

    protected function sendNotify(UserModel $userModel, ActivateUserTokenModel $token)
    {
        $this->notifyService->setToken($token)->send($userModel);
    }

    protected function openSalary(SalaryModel $salaryModel)
    {
        return $this->financialOpenService->store($salaryModel);
    }
}
