<?php

namespace App\Src\Repositories\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Mappers\Hyper\Contract\EmployeeContractEloquentMapper;
use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ContractRepository implements IContractRepository
{
    public function get(PaginationContractModel $paginationContractModel)
    {
        $limit = $paginationContractModel->getLimit();
        $contracts = EmploymentContract::select(
            'employment_contracts.*',
            DB::raw("TIMESTAMPDIFF(MONTH, start_date, end_date) AS contract_in_months"),
            DB::raw("CONCAT(`first_name`, `insertion`, `last_name`) AS employee_name")
        )
            ->has('employmentOldContractActions', '=', 0)
            ->join('users', 'employment_contracts.user_id', '=', 'users.id')
            ->Search($paginationContractModel)
            ->with('user')
            ->get();


        $countContracts = EmploymentContract::Search($paginationContractModel->setLimit(null))->count();
        $paginationContractModel->setLimit($limit);

        $mappedContracts = EmployeeContractEloquentMapper::toCollectionEmployeeContractModel($contracts);

        return $paginationContractModel->setItems($mappedContracts)->setTotalItems($countContracts);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function findByUserId(int $userId)
    {
        return EmploymentContract::where('user_id', $userId)->get();
    }
}
