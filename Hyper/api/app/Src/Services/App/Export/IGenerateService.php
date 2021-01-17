<?php


namespace App\Src\Services\Hyper\Export;

use App\Src\Models\Hyper\Pagination\PaginationModel;

interface IGenerateService
{
    public function generate(PaginationModel $paginationModel);
}
