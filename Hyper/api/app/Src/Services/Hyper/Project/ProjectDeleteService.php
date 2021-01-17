<?php


namespace App\Src\Services\Hyper\Project;

use App\Exceptions\Project\ProjectAttachedException;
use App\Exceptions\Project\ProjectNotFoundException;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;

class ProjectDeleteService implements IProjectDeleteService
{
    /**
     * @var IProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ICommissionRateDeleteService
     */
    protected $commissionRateDeleteService;

    public function __construct(
        IProjectRepository $projectRepository,
        ICommissionRateDeleteService $commissionRateDeleteService
    ) {
        $this->projectRepository = $projectRepository;
        $this->commissionRateDeleteService = $commissionRateDeleteService;
    }

    /**
     * @param  int $id
     * @return bool
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $project = $this->projectRepository->findById($id);

        if (!$project) {
            throw new ProjectNotFoundException();
        }

        $countProjectEmployees = $this->projectRepository->countProjectEmployees($id);

        if ($countProjectEmployees) {
            throw new ProjectAttachedException();
        }

        $this->commissionRateDeleteService->deleteByProjectId($id);

        return $this->projectRepository->delete($id);
    }
}
