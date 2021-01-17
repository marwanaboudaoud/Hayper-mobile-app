<?php

 namespace App\Src\Services\Hyper\Salary;

  use App\Src\Models\Hyper\Salary\SalaryRowModel;
  use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
  use Illuminate\Support\Collection;

class SalaryRowStoreService implements ISalaryRowStoreService
{
    /**
     * @var  ISalaryRowRepository
     */
    private $salaryRowRepository;

    public function __construct(ISalaryRowRepository $salaryRowRepository)
    {
        $this->salaryRowRepository = $salaryRowRepository;
    }

    public function store(SalaryRowModel $salaryRowModel)
    {
        return $this->salaryRowRepository->store($salaryRowModel);
    }

    public function storeBatch(Collection $collection)
    {
        return $collection->map(function (SalaryRowModel $item) {
            return $this->store($item);
        });
    }
}
