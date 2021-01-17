<?php



namespace App\Src\Services\Hyper\Contract;

use App\Exceptions\Contract\ContractNotFoundException;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Contract\EmployeeContractRepository;
use App\Src\Repositories\Hyper\Contract\IContractRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractOnePdfGenerator;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractThreePdfGenerator;
use App\Src\Services\App\FileGenerator\Pdf\Contract\EmployeeContractTwoPdfGenerator;
use App\Src\Services\Hyper\Export\IExportService;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use App\Http\Requests\Pagination\ContractSearchRequest;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class ContractService implements IContractService
{
    /**
     * @var IcontractRepository
     */
    private $contractRepository;

    /**
     * @var ContractExportService
     */
    private $contractExportService;

    /**
     * @var IEmployeeContractRepository
     */
    private $employeeContractRepository;

    /**
     * ContractService constructor.
     * @param IContractRepository $contractRepository
     * @param ContractExportService $contractExportService
     * @param IEmployeeContractRepository $employeeContractRepository
     */
    public function __construct(
        IContractRepository $contractRepository,
        ContractExportService $contractExportService,
        IEmployeeContractRepository $employeeContractRepository
    ) {
        $this->contractRepository = $contractRepository;
        $this->contractExportService = $contractExportService;
        $this->employeeContractRepository = $employeeContractRepository;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ContractNotFoundException
     */
    public function find(int $id)
    {
        $contract = $this->employeeContractRepository->find($id);
        if (!$contract) {
            throw new ContractNotFoundException();
        }

        return $contract;
    }

    /**
     * @inheritDoc
     */
    public function findByUserId(int $userId)
    {
        return $this->employeeContractRepository->findByUserId($userId);
    }

    /**
     * @param PaginationContractModel $paginationContractModel
     * @return Collection
     */
    public function get(PaginationContractModel $paginationContractModel)
    {
        return $this->contractRepository->get($paginationContractModel);
    }

    public function export(EmployeeContractModel $employeeContractModel)
    {
        $foundContract = $this->find($employeeContractModel->getId());
        $fileName = $foundContract->getDocumentNumber() . '.pdf';

        return $this->contractExportService->export($fileName);
    }

    /**
     * @inheritDoc
     * @throws ContractNotFoundException
     */
    public function generatePdf(UserModel $userModel)
    {
        $countContracts = $this->employeeContractRepository->findByUserId($userModel->getId())->count();

        switch ($countContracts) {
            case 0:
                (new EmployeeContractOnePdfGenerator($userModel->setBsn(1)))->save();
                break;
            case 1:
                (new EmployeeContractTwoPdfGenerator($userModel->setBsn(1)))->save();
                break;
            case 2:
                (new EmployeeContractThreePdfGenerator($userModel->setBsn(1)))->save();
                break;
            default:
                throw new ContractNotFoundException();
        }
    }
}
