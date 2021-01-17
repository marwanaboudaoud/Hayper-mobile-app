<?php

 namespace App\Src\Services\Hyper\Contract;

  use App\Src\Models\Hyper\Pagination\PaginationModel;
  use App\Src\Repositories\Hyper\Contract\IContractExpireRepository;

class ContractExpireService implements IContractExpireService
{
    /**
     * @var  IContractExpireRepository
     */
    private $contractExpireRepository;

    public function __construct(IContractExpireRepository $contractExpireRepository)
    {
        $this->contractExpireRepository = $contractExpireRepository;
    }

    public function get(PaginationModel $paginationModel)
    {
        return $this->contractExpireRepository->get($paginationModel);
    }
}
