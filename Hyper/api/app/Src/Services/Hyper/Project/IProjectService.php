<?php


namespace App\Src\Services\Hyper\Project;

use App\Src\Models\Hyper\Pagination\PaginationProjectModel;

interface IProjectService
{
    public function get(PaginationProjectModel $paginationProjectModel);

    public function find(int $id);
}
