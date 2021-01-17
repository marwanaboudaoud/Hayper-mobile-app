<?php


namespace App\Src\Services\Hyper\CommissionRate;

use App\Src\Repositories\Hyper\CommissionRate\ICommissionRateRepository;

class CommissionRateDeleteService implements ICommissionRateDeleteService
{
    /**
     * @var ICommissionRateRepository
     */
    private $commissionRateRepository;

    public function __construct(ICommissionRateRepository $commissionRateRepository)
    {
        $this->commissionRateRepository = $commissionRateRepository;
    }

    /**
     * @inheritDoc
     */
    public function deleteByProjectId(int $projectId): bool
    {
        return $this->commissionRateRepository->delete([
            'project_id' => $projectId
        ]);
    }
}
