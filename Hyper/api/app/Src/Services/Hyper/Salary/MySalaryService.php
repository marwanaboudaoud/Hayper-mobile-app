<?php

 namespace App\Src\Services\Hyper\Salary;

  use App\Src\Models\Hyper\Salary\MySalaryModel;
  use App\Src\Repositories\Hyper\Salary\IMySalaryRepository;

class MySalaryService implements IMySalaryService
{
    /**
     * @var  IMySalaryRepository
     */
    private $mySalaryRepository;

    public function __construct(IMySalaryRepository $mySalaryRepository)
    {
        $this->mySalaryRepository = $mySalaryRepository;
    }


    public function get(MySalaryModel $mySalaryModel)
    {
        return $this->mySalaryRepository->get($mySalaryModel);
    }
}
