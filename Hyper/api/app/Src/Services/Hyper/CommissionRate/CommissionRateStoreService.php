<?php


namespace App\Src\Services\Hyper\CommissionRate;

use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use App\Src\Repositories\Hyper\CommissionRate\ICommissionRateRepository;
use App\Src\Services\Hyper\Role\IRoleService;
use Illuminate\Support\Collection;

class CommissionRateStoreService implements ICommissionRateStoreService
{
    /**
     * @var ICommissionRateRepository
     */
    private $commissionRateRepository;

    /**
     * @var IRoleService
     */
    private $roleService;

    public function __construct(
        ICommissionRateRepository $commissionRateRepository,
        IRoleService $roleService
    ) {
        $this->commissionRateRepository = $commissionRateRepository;
        $this->roleService = $roleService;
    }

    /**
     * @inheritDoc
     */
    public function store(CommissionRateModel $model)
    {
        $this->roleService->findById($model->getRoleId());

        return $this->commissionRateRepository->store($model);
    }

    /**
     * @param Collection|null $commissionRates
     * @return Collection
     */
    public function storeCollection(Collection $commissionRates)
    {
        return $commissionRates->map(function (CommissionRateModel $model) {
            return $this->store($model);
        });
    }
}
