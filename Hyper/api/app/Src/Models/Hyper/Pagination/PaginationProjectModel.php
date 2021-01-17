<?php


namespace App\Src\Models\Hyper\Pagination;

use App\Src\Models\Hyper\Project\ProjectModel;

class PaginationProjectModel extends PaginationModel
{
    /**
     * @var ?ProjectModel
     */
    private $project;

    /**
     * @return ProjectModel|null
     */
    public function getProject(): ?ProjectModel
    {
        return $this->project;
    }

    /**
     * @param ProjectModel|null $project
     * @return PaginationProjectModel|null
     */
    public function setProject(?ProjectModel $project): ?PaginationProjectModel
    {
        $this->project = $project;
        return $this;
    }
}
