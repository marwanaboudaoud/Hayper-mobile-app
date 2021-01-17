<?php


namespace App\Src\Repositories\Hyper\Project;

use App\Project;
use App\Src\Mappers\Hyper\Partner\PartnerCollectionMapper;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Mappers\Hyper\Project\ProjectModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Project\ProjectModel;

class ProjectRepository implements IProjectRepository
{
    /**
     * @param PaginationProjectModel $paginationProjectModel
     * @return PaginationModel
     */
    public function get(PaginationProjectModel $paginationProjectModel)
    {
        $projects = Project::Search($paginationProjectModel)
            ->with(['partner', 'commissionRates'])
            ->get();

        $limit = $paginationProjectModel->getLimit();
        $paginationProjectModel->setLimit(null);

        $count = Project::Search($paginationProjectModel)
            ->count();

        $models = ProjectEloquentMapper::toCollectionModel($projects);

        return $paginationProjectModel->setItems($models)
            ->setTotalItems($count)
            ->setLimit($limit);
    }

    /**
     * @param ProjectModel $projectModel
     * @return ProjectModel
     */
    public function store(ProjectModel $projectModel)
    {
        $model = ProjectModelMapper::toEloquentModel($projectModel);
        $model->save();

        return ProjectEloquentMapper::toModel($model);
    }

    /**
     * @param int $id
     * @return ProjectModel|null
     */
    public function findById(int $id)
    {
        if (!$id) {
            return null;
        }

        $eloquentModel = Project::with(['partner', 'commissionRates'])->find($id);

        if (!$eloquentModel) {
            return null;
        }

        return ProjectEloquentMapper::toModel($eloquentModel);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        $foundProject = Project::find($id);

        if (!$foundProject) {
            return null;
        }

        $foundProject->delete();

        return true;
    }

    /**
     * @param int $id
     * @return int|null
     */
    public function countProjectEmployees(int $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return null;
        }

        return $project->employees()->count();
    }

    public function update(ProjectModel $updateModel)
    {
        $oldModel = $this->findById($updateModel->getId());

        if (!$oldModel) {
            return false;
        }

        $model = ProjectModelMapper::toEloquentUpdateModel($oldModel, $updateModel);
        $model->save();

        return ProjectEloquentMapper::toModel($model);
    }
}
