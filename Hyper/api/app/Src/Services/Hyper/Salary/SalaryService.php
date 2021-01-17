<?php


namespace App\Src\Services\Hyper\Salary;

use App\Exceptions\Salary\SalaryNotFoundException;
use App\Salary;
use App\Src\Mappers\Hyper\Salary\SalaryModelMapper;
use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Repositories\Hyper\Salary\ISalaryRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;

class SalaryService implements ISalaryService
{
    /**
     * @var ISalaryRepository
     */
    protected $salaryRepository;

    /**
     * @var ISalaryRowRepository
     */
    protected $salaryRowRepository;

    public function __construct(ISalaryRepository $salaryRepository, ISalaryRowRepository $salaryRowRepository)
    {
        $this->salaryRepository = $salaryRepository;
        $this->salaryRowRepository = $salaryRowRepository;
    }

    /**
     * @param int $id
     * @return SalaryModel
     * @throws SalaryNotFoundException
     */
    public function find(int $id)
    {
        $salary = $this->salaryRepository->find($id);

        if (!$salary) {
            throw new SalaryNotFoundException();
        }

        $subTotalExBonus = $this->salaryRowRepository->getSubTotalPerDayExclBonusBySalaryId($id);
        $subTotalBonus = $this->salaryRowRepository->getSubTotalPerDayBonusBySalaryId($id);
        $subTotalInclBonus = $this->salaryRowRepository->getSubTotalPerDayInclBonusBySalaryId($id);

        $salary = SalaryModelMapper::toModelWithSubTotal($salary, $subTotalExBonus, $subTotalBonus, $subTotalInclBonus);

        return $salary;
    }

    public function get(SalaryPaginationModel $salaryPaginationModel)
    {
        return $this->salaryRepository->get($salaryPaginationModel);
    }
}
