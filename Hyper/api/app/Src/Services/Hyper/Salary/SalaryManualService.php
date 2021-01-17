<?php


namespace App\Src\Services\Hyper\Salary;

use App\Exceptions\Salary\SalaryDeleteException;
use App\Exceptions\Salary\SalaryRowNotFound;
use App\Src\Repositories\Hyper\Salary\ISalaryManualRepository;

class SalaryManualService implements ISalaryManualService
{
    /**
     * @var ISalaryManualRepository
     */
    private $salaryManualRepository;

    public function __construct(ISalaryManualRepository $salaryManualRepository)
    {
        $this->salaryManualRepository = $salaryManualRepository;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws SalaryRowNotFound
     */
    public function find(int $id)
    {
        $foundSalary = $this->salaryManualRepository->find($id);

        if (!$foundSalary) {
            throw new SalaryRowNotFound();
        }

        return $foundSalary;
    }
}
