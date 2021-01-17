<?php


namespace App\Src\Services\Hyper\Salary;

use App\Exceptions\Salary\SalaryDeleteException;
use App\Exceptions\Salary\SalaryRowNotFound;
use App\Exceptions\SalaryRowManual\SalaryClosedException;
use App\Src\Repositories\Hyper\Salary\ISalaryManualDeleteRepository;

class SalaryRowManualDeleteService implements ISalaryRowManualDeleteService
{
    /**
     * @var ISalaryManualDeleteRepository
     */
    private $salaryManualDeleteRepository;

    /**
     * @var ISalaryService
     */
    private $salaryService;

    /**
     * @var ISalaryManualService
     */
    private $salaryManualService;

    public function __construct(
        ISalaryManualService $salaryManualService,
        ISalaryService $salaryService,
        ISalaryManualDeleteRepository $salaryManualDeleteRepository
    ) {
        $this->salaryManualDeleteRepository = $salaryManualDeleteRepository;
        $this->salaryService = $salaryService;
        $this->salaryManualService = $salaryManualService;
    }

    /**
     * @param int $id
     * @throws SalaryClosedException
     */
    public function delete(int $id)
    {
        $salaryDay = $this->salaryManualService->find($id);

        $salary = $this->salaryService->find($salaryDay->getSalaryId());

        if ($salary->isClosed()) {
            throw new SalaryClosedException();
        }

        $this->salaryManualDeleteRepository->delete($id);
    }
}
