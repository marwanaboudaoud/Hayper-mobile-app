<?php


namespace App\Src\Services\Hyper\MaritalStatus;

use App\Src\Repositories\MaritalStatus\IMaritalStatusRepository;

class MaritalStatusService implements IMaritalStatusService
{

    /**
     * @var IMaritalStatusRepository
     */
    private $maritalStatusRepository;

    /**
     * MaritalStatusService constructor.
     * @param IMaritalStatusRepository $maritalStatusRepository
     */
    public function __construct(IMaritalStatusRepository $maritalStatusRepository)
    {
        $this->maritalStatusRepository = $maritalStatusRepository;
    }


    /**
     * @inheritDoc
     */
    public function get()
    {
        return $this->maritalStatusRepository->get();
    }
}
