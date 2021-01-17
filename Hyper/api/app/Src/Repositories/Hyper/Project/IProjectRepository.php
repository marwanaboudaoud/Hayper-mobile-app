<?php


namespace App\Src\Repositories\Hyper\Project;

use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;

interface IProjectRepository
{
    /**
     * @param PaginationProjectModel $paginationProjectModel
     * @return Collection
     */
    public function get(PaginationProjectModel $paginationProjectModel);

    /**
     * @param ProjectModel $projectModel
     * @return ProjectModel
     */
    public function store(ProjectModel $projectModel);

    /**
     * @param int $id
     * @return ProjectModel
     */
    public function findById(int $id);

    public function delete(int $id);

    public function countProjectEmployees(int $id);

    /**
     * @param ProjectModel $updatedModel
     * @return ProjectModel
     */
    public function update(ProjectModel $updatedModel);
}
