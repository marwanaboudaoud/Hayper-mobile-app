<?php


namespace App\Src\Services\Hyper\Project;

use App\Src\Models\Hyper\Project\ProjectModel;

interface IProjectUpdateService
{
    public function update(ProjectModel $updatedModel);
}
