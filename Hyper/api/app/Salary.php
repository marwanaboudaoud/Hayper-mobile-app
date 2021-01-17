<?php

namespace App;

use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salary extends Model
{
    public function salaryDays()
    {
        return $this->hasMany(SalaryDay::class)->where('is_manual', false);
    }

    public function salaryManual()
    {
        return $this->hasMany(SalaryDay::class)->where('is_manual', true);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeId($query, $id)
    {
        $id ? $query->where('salary_days.salary_id', 'LIKE', '%' . $id . '%') : null;
    }

    public function scopeEmployeeName($query, $employeeName)
    {
        $employeeName ? $query->whereHas('employee', function (Builder $query) use ($employeeName) {
            $query->where(
                DB::raw("CONCAT(`first_name`, `insertion`, `last_name`)"),
                'LIKE',
                "%" . $employeeName . "%"
            );
        }) : null;
    }

    public function scopeHeading($query, $heading)
    {
        $heading ? $query->where('heading', 'LIKE', '%' . $heading . '%') : null;
    }

    public function scopeDate($query, $date)
    {
        $date ? $query->where('salaries.date', 'LIKE', '%' . $date . '%') : null;
    }

    public function scopeDescription($query, $description)
    {
        $description ? $query->where('salaries.description', 'LIKE', '%' . $description . '%') : null;
    }

    public function scopeMonth($query, $month)
    {
        $month ? $query->whereMonth('salaries.date', $month) : null;
    }

    public function scopeYear($query, $year)
    {
        $year ? $query->whereYear('salaries.date', $year) : null;
    }

    public function scopeFilter($query, SalaryPaginationModel $filter)
    {
        $filter ? $query->Month($filter->getMonth())
            ->Year($filter->getYear()) : null;
    }

    public function scopeClosed($query, $isClosed)
    {
        (isset($isClosed)) ? $query->where('is_closed', $isClosed) : null;
    }

    public function scopeIsClosed($query)
    {
        $this->scopeClosed($query, true);
    }

    public function scopeIsNotClosed($query)
    {
        $this->scopeClosed($query, false);
    }

    public function scopeFullName($query, $fullName)
    {
        $fullName ? $query->where(
            DB::raw("CONCAT(`first_name`, `insertion`, `last_name`) AS employee_name"),
            'LIKE',
            "%" . $fullName . "%") :
            null;
    }

//    public function scopeSalary($query, $salary)
//    {
//        $salary ? $query->where(DB::raw("SUM(salary_rows.price * salary_rows.amount)"),
//            'LIKE',
//            "%" . $salary . "%") :
//            null;
//    }

    /**
     * @param $query
     * @param SalaryPaginationModel $salaryPaginationModel
     */
    public function scopeSearch($query, SalaryPaginationModel $salaryPaginationModel)
    {
        $query->Id($salaryPaginationModel->getId())
            ->EmployeeName($salaryPaginationModel->getEmployeeName())
            ->Heading($salaryPaginationModel->getHeading())
            ->Date($salaryPaginationModel->getDate())
            ->Description($salaryPaginationModel->getDescription())
            ->Filter($salaryPaginationModel);


        if ($salaryPaginationModel->getLimit()) {
            $query->limit($salaryPaginationModel->getLimit())
                ->offset($salaryPaginationModel->getLimit() * ($salaryPaginationModel->getPage() - 1));
        }

        if ($salaryPaginationModel->getOrderBy() && $salaryPaginationModel->getDirection()) {
            $query->orderBy($salaryPaginationModel->getOrderBy(), $salaryPaginationModel->getDirection());
        }
    }
}
