<?php


namespace App\Src\Repositories\Hyper\Salary;

use App\Salary;
use App\Src\Mappers\Hyper\Salary\SalaryEloquentMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use App\Src\Services\Hyper\Salary\ISalaryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class SalaryRepository implements ISalaryRepository
{
    /**
     * @var ISalaryRowRepository
     */
    private $rowRepository;

    public function __construct(ISalaryRowRepository $rowRepository)
    {
        $this->rowRepository = $rowRepository;
    }

    /**
     * @param int $id
     * @return SalaryModel
     */
    public function find(int $id)
    {
        $salary = Salary::with(
            [
               'employee',
               'salaryDays' => function ($q) {
                    $q->with('salaryRows');
               },
               'salaryManual' => function ($q) {
                   $q->with('salaryRows');
                   $q->with('partner');
               },
            ]
        )->where('id', $id)->first();

        if (!$salary) {
            return null;
        }

        return SalaryEloquentMapper::toModel($salary);
    }

    protected function getQuery(SalaryPaginationModel $salaryPaginationModel)
    {
        return Salary::Search($salaryPaginationModel)->select(
            DB::raw(
                "salary_days.salary_id AS id, user_id, salaries.date, heading, salaries.description,
                 SUM(salary_rows.price * salary_rows.amount) as salary,
                 CONCAT(`first_name`, `insertion`, `last_name`) AS employee_name"
            )
        )
            ->join('salary_days', 'salaries.id', '=', 'salary_days.salary_id')
            ->join('salary_rows', 'salary_days.id', '=', 'salary_rows.salary_day_id')
            ->join('users', 'salaries.user_id', '=', 'users.id')
            ->groupBy('id')
            ->having('salary', 'LIKE', '%' . $salaryPaginationModel->getSalary() . '%')
            ->with(['employee']);
    }

    /**
     * @param SalaryPaginationModel $salaryPaginationModel
     * @return PaginationModel
     */
    public function get(SalaryPaginationModel $salaryPaginationModel)
    {
        $limit = $salaryPaginationModel->getLimit();
        $salaries = $this->getQuery($salaryPaginationModel)->get();

        $count = $this->getQuery($salaryPaginationModel->setLimit(null))->get()->count();

        $mappedSalaries = SalaryEloquentMapper::toCollectionModel($salaries);

        return $salaryPaginationModel->setItems($mappedSalaries)
            ->setLimit($limit)
            ->setTotalItems($count);
    }
}
