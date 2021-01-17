<?php

namespace App\Src\Services\Hyper\Salary;

use App\Exceptions\Salary\SalaryNotFoundException;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryRowModel;
use App\Src\Repositories\Hyper\Salary\ISalaryDayRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
use App\Src\Services\Hyper\Partner\IPartnerService;

class SalaryDayStoreService implements ISalaryDayStoreService
{
    /**
     * @var  ISalaryDayRepository
     */
    protected $salaryDayRepository;

    /**
     * @var ISalaryService
     */
    protected $salaryService;

    /**
     * @var ISalaryRowStoreService
     */
    protected $salaryRowStoreService;

    public function __construct(
        ISalaryDayRepository $salaryDayRepository,
        SalaryService $salaryService,
        SalaryRowStoreService $salaryRowStoreService
    ) {
        $this->salaryDayRepository = $salaryDayRepository;
        $this->salaryService = $salaryService;
        $this->salaryRowStoreService = $salaryRowStoreService;
    }


    /**
     * @param SalaryDayModel $salaryDayModel
     * @return mixed
     * @throws SalaryNotFoundException
     */
    public function store(SalaryDayModel $salaryDayModel)
    {
        $this->salaryService->find($salaryDayModel->getSalaryId());

        $storedSalaryDay =  $this->salaryDayRepository->store($salaryDayModel);

        $salaryDayModel->getRows()->map(function (SalaryRowModel $salaryRowModel) use ($storedSalaryDay) {
            $salaryRowModel->setSalaryDayId($storedSalaryDay->getId());
        });

        $row = $this->salaryRowStoreService->storeBatch($salaryDayModel->getRows());

        return $storedSalaryDay->setRows($row);
    }
}
