<?php


namespace App\Src\Services\Hyper\Project;

use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateStoreService;
use App\Src\Services\Hyper\Partner\IPartnerService;
use Illuminate\Support\Collection;

class ProjectStoreService implements IProjectStoreService
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
    private $commissionRateService;

    public function __construct(
        IProjectRepository $projectRepository,
        IPartnerService $partnerService,
        ICommissionRateStoreService $commissionRateService
    ) {
        $this->projectRepository = $projectRepository;
        $this->partnerService = $partnerService;
        $this->commissionRateService = $commissionRateService;
    }

    /**
     * @param ProjectModel $projectModel
     * @return ProjectModel
     */
    public function store(ProjectModel $projectModel)
    {
        $this->partnerService->find($projectModel->getPartnerId());

        $project = $this->projectRepository->store($projectModel);
        $commissionRates = $projectModel->getCommissionRates();

        $commissionRates->map(function (CommissionRateModel $commissionRateModel) use ($project) {
            return $commissionRateModel->setProjectId($project->getId());
        });

        $this->commissionRateService->storeCollection($commissionRates);


        return $this->projectRepository->findById($project->getId());
    }

    /**
     * @param  Collection $collection
     * @return Collection
     */
    public function storeCollection(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return $this->store($item);
            }
        );
    }
}
