<?php


namespace App\Src\Services\Hyper\Salary;

use App\Exceptions\SalaryRowManual\SalaryClosedException;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryRowModel;
use App\Src\Repositories\Hyper\Salary\ISalaryDayRepository;

class SalaryRowManualStoreService extends SalaryDayStoreService
{
    /**
     * @param SalaryDayModel $salaryDayModel
     * @return mixed
     * @throws SalaryClosedException
     * @throws SalaryNotFoundException
     * @throws \App\Exceptions\Salary\SalaryNotFoundException
     */
    public function store(SalaryDayModel $salaryDayModel)
    {
        $salary = $this->salaryService->find($salaryDayModel->getSalaryId());

        if ($salary->isClosed()) {
            throw new SalaryClosedException();
        }

        $salaryDayModel->setIsManual(true);
        $salaryDayModel->setHasDriven(false);
        $salaryDayModel->getRows()->map(function (SalaryRowModel $item) {
            $item->setBonus(false);
        });

        return parent::store($salaryDayModel);
    }
}
