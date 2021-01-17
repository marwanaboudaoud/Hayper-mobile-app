<?php


namespace App\Src\Services\Hyper\Project;

use App\Exceptions\Project\ProjectNotFoundException;
use App\Src\Mappers\Hyper\Project\ProjectCollectionMapper;
use App\Src\Mappers\Hyper\Project\ProjectPartnerCollectionMapper;
use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Services\Hyper\Partner\IPartnerService;

class ProjectService implements IProjectService
{
    /**
     * @var IProjectRepository
     */
    private $projectRepository;


    public function __construct(IProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param PaginationProjectModel $paginationProjectModel
     * @return mixed
     */
    public function get(PaginationProjectModel $paginationProjectModel)
    {
        return $this->projectRepository->get($paginationProjectModel);
    }

    /**
     * @param int $id
     * @throws ProjectNotFoundException
     * @return ProjectModel
     */
    public function find(int $id)
    {
        $result = $this->projectRepository->findById($id);

        if (!$result) {
            throw new ProjectNotFoundException();
        }

        return $result;
    }
}
