<?php


namespace App\Src\Services\Hyper\Project;

use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;

interface IProjectStoreService
{
    public function store(ProjectModel $projectModel);

    public function storeCollection(Collection $collection);
}
