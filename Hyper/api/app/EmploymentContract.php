<?php

namespace App;

use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class EmploymentContract extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_date',
        'end_date',
        'trial_per_day',
        'user_id',
        'document_number',
        'expiration_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employmentOldContractActions()
    {
        return $this->hasMany(EmploymentContractAction::class, 'contract_id');
    }

    public function employmentContractActions()
    {
        return $this->hasMany(EmploymentContractAction::class, 'new_contract_id');
    }

    public function scopeId($query, $id)
    {
        $id ? $query->where('id', 'LIKE', '%' . $id . '%') : null;
    }

    public function scopeStartDate($query, $startDate)
    {
        $startDate ? $query->where('start_date', 'LIKE', '%' . $startDate . '%') : null;
    }

    public function scopeEndDate($query, $endDate)
    {
        $endDate ? $query->where('end_date', 'LIKE', '%' . $endDate . '%') : null;
    }

    public function scopeEmployeeName($query, $employeeName)
    {
        $employeeName ? $query->whereHas('user', function (Builder $query) use ($employeeName) {
            $query->where(
                DB::raw("CONCAT(`first_name`, `insertion`, `last_name`)"),
                'LIKE',
                "%" . $employeeName . "%"
            );
        }) : null;
    }

    public function scopeContractInMonths($query, $contractInMonths)
    {
        $contractInMonths ? $query->where(
            DB::raw("CONCAT(TIMESTAMPDIFF(MONTH, start_date, end_date), ' maanden')"),
            'LIKE',
            "%" . $contractInMonths . "%"
        ) : null;
    }

    public function scopeSearch($query, PaginationContractModel $paginationContractModel)
    {
        $query->Id($paginationContractModel->getId())
            ->StartDate($paginationContractModel->getStartDate())
            ->EndDate($paginationContractModel->getEndDate())
            ->EmployeeName($paginationContractModel->getEmployeeName())
            ->ContractInMonths($paginationContractModel->getContractInMonths());

        if ($paginationContractModel->getLimit()) {
            $query->limit($paginationContractModel->getLimit())
                ->offset($paginationContractModel->getLimit() * ($paginationContractModel->getPage() - 1));
        }

        if ($paginationContractModel->getOrderBy() && $paginationContractModel->getDirection()) {
            $query->orderBy($paginationContractModel->getOrderBy(), $paginationContractModel->getDirection());
        }
    }
}
