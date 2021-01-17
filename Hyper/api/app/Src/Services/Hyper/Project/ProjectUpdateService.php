<?php


namespace App\Src\Services\Hyper\Project;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateStoreService;
use App\Src\Services\Hyper\Partner\IPartnerService;

class ProjectUpdateService implements IProjectUpdateService
{
    /**
     * @var IProjectRepository
     */
    private $projectRepository;

    /**
     * @var IPartnerService
     */
    private $partnerService;

    /**
     * @var ICommissionRateStoreService
     */
    private $commissionRateStoreService;
    /**
     * @var ICommissionRateDeleteService
     */
    private $commissionRateDeleteService;


    public function __construct(
        IProjectRepository $projectRepository,
        IPartnerService $partnerService,
        ICommissionRateStoreService $commissionRateStoreService,
        ICommissionRateDeleteService $commissionRateDeleteService
    ) {
        $this->projectRepository = $projectRepository;
        $this->partnerService = $partnerService;
        $this->commissionRateStoreService = $commissionRateStoreService;
        $this->commissionRateDeleteService = $commissionRateDeleteService;
    }

    /**
     * @param ProjectModel $updatedModel
     * @return ProjectModel
     * @throws ProjectNotFoundException
     */
    public function update(ProjectModel $updatedModel)
    {
        $foundProject = $this->projectRepository->findById($updatedModel->getId());

        if (!$foundProject) {
            throw new ProjectNotFoundException();
        }

        $this->partnerService->find($updatedModel->getPartnerId());

        $this->commissionRateDeleteService->deleteByProjectId($updatedModel->getId());
        $this->commissionRateStoreService->storeCollection($updatedModel->getCommissionRates());

        return $this->projectRepository->update($updatedModel);
    }
}
