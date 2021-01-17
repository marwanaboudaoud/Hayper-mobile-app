<?php


namespace App\Src\Mappers\Request\Salary;

use App\Http\Requests\Pagination\SalaryPaginationRequest;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\SalaryPaginationModel;
use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;

class SalaryRequestSearchMapper
{
    /**
     * @param SalaryPaginationRequest $salaryPaginationRequest
     * @return SalaryPaginationModel
     */
    public static function toPaginationModel(SalaryPaginationRequest $salaryPaginationRequest)
    {
        $salary = $salaryPaginationRequest->search ?? $salaryPaginationRequest;
        $salary = json_decode(json_encode($salary));

        $filter = $salaryPaginationRequest->filter ?? $salaryPaginationRequest;
        $filter = json_decode(json_encode($filter));

        return (new SalaryPaginationModel())
            ->setPrice(propExistOrNull($salary, 'price'))
            ->setMonth(propExistOrNull($filter, 'month'))
            ->setYear(propExistOrNull($filter, 'year'))
            ->setEmployeeName(propExistOrNull($salary, 'employee_name'))
            ->setDate(propExistOrNull($salary, 'date'))
            ->setHeading(propExistOrNull($salary, 'heading'))
            ->setDescription(propExistOrNull($salary, 'description'))
            ->setPage($salaryPaginationRequest->page)
            ->setLimit($salaryPaginationRequest->limit)
            ->setOrderBy($salaryPaginationRequest->order_by)
            ->setDirection($salaryPaginationRequest->direction)
            ->setId((int)propExistOrNull($salary, 'id'))
            ->setEmployeeName(propExistOrNull($salary, 'employee_name'))
            ->setDate(propExistOrNull($salary, 'date'))
            ->setHeading(propExistOrNull($salary, 'heading'))
            ->setDescription(propExistOrNull($salary, 'description'))
            ->setPrice(propExistOrNull($salary, 'price'))
            ->setSalary(propExistOrNull($salary, 'salary'));
    }
}
