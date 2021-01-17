<?php

namespace App\Src\Repositories\Hyper\Contract;

use App\Src\Models\Hyper\Pagination\PaginationContractModel;

interface IContractRepository
{
    public function get(PaginationContractModel $paginationContractModel);

    public function findByUserId(int $userId);
}
