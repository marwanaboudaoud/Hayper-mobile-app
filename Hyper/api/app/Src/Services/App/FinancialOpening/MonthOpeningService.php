<?php


namespace App\Src\Services\App\FinancialOpening;

use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Repositories\App\Financial\IFinancialOpenRepository;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class MonthOpeningService implements IFinancialOpenService
{
    /**
     * @var IFinancialOpenRepository
     */
    private $financialOpenRepository;


    /**
     * MonthOpeningService constructor.
     * @param IFinancialOpenRepository $financialOpenRepository
     */
    public function __construct(IFinancialOpenRepository $financialOpenRepository)
    {
        $this->financialOpenRepository = $financialOpenRepository;
    }

    /**
     * @param Collection $salaryCollection
     * @return bool|mixed
     */
    public function storeCollection(Collection $salaryCollection)
    {
        $salaryCollection->each(function (SalaryModel $item) {
            $item->setDate($item->getDate()->addMonth());
            $this->financialOpenRepository->store($item);
        });

        return true;
    }

    public function store(SalaryModel $salaryModel)
    {
        $this->financialOpenRepository->store($salaryModel);
    }
}
