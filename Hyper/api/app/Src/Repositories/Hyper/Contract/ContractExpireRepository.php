<?php

namespace App\Src\Repositories\Hyper\Contract;

use App\EmploymentContract;
use App\Src\Mappers\Hyper\Contract\EmployeeContractEloquentMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ContractExpireRepository implements IContractExpireRepository
{
    private $orderByAttributes = [
        'employee_name',
        'contract_in_months',
        'end_date',
        'till_end_date_in_days',
        'amount_contracts'
    ];

    /**
     * @param PaginationModel $paginationModel
     * @return \Illuminate\Support\Collection
     */
    public function get(PaginationModel $paginationModel)
    {;
        $date = Carbon::now()->toDateString();
        $expireDate = Carbon::now()->addMonths(2)->toDateString();

        $excludeContractIds = EmploymentContract::whereHas('employmentOldContractActions', function ($query) {
            $query->where('is_extended', false);
        })->get()->pluck('id')->toArray();

        $contracts = EmploymentContract::select(
            'employment_contracts.*',
            DB::raw("TIMESTAMPDIFF(MONTH, start_date, end_date) AS contract_in_months"),
            DB::raw("TIMESTAMPDIFF(DAY, NOW(), end_date) AS till_end_date_in_days"),
            DB::raw("CONCAT(`first_name`, `insertion`, `last_name`) AS employee_name")
        )
            ->has('employmentOldContractActions', '=', 0)
            ->join('users', 'employment_contracts.user_id', '=', 'users.id')
            ->orderBy($paginationModel->getOrderBy(), $paginationModel->getDirection())
            ->whereBetween('end_date', [
                $date,
                $expireDate
            ])
            ->with(['user' => function ($query) use ($paginationModel) {
                $query->withCount('contracts');
            }])
            ->whereNotIn('employment_contracts.id', $excludeContractIds);

        if ($paginationModel->getOrderBy() && $paginationModel->getDirection()
            && array_key_exists($paginationModel->getOrderBy(), $this->orderByAttributes)
        ) {
            if (strpos($paginationModel->getOrderBy(), "users.") !== true) {
                $contracts = $contracts->orderBy($paginationModel->getOrderBy(), $paginationModel->getDirection());
            }
        }

        $contracts = $contracts->get();

//        dd($this->ORDER_COLUMN);
        return EmployeeContractEloquentMapper::toContractExpireModelCollection($contracts);
    }
}
