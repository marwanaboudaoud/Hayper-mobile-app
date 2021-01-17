<?php

namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Models\Hyper\Pagination\PaginationModel;

interface IContractExpireRepository
{
    public function get(PaginationModel $paginationModel);
}
