<?php

namespace App\Src\Services\Hyper\Contract;

use App\Src\Models\Hyper\Pagination\PaginationModel;
use Illuminate\Support\Collection;

interface IContractExpireService
{
    /**
     * @param PaginationModel $paginationModel
     * @return Collection
     */
    public function get(PaginationModel $paginationModel);
}
