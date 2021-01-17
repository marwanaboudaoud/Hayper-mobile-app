<?php


namespace App\Src\Mappers\Request\Contract;

use App\Http\Requests\Pagination\ContractSearchRequest;
use App\Src\Models\Hyper\Pagination\PaginationContractModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use Carbon\Carbon;

class ContractSearchRequestMapper
{
    /**
     * @param ContractSearchRequest $request
     * @return PaginationModel
     */
    public static function toModel(ContractSearchRequest $request)
    {
        return (new PaginationContractModel())
            ->setId((int)keyExistOrNull($request, 'search', 'id'))
            ->setStartDate(keyExistOrNull($request, 'search', 'start_date'))
            ->setEndDate(keyExistOrNull($request, 'search', 'end_date'))
            ->setEmployeeName(keyExistOrNull($request, 'search', 'employee_name'))
            ->setContractInMonths(keyExistOrNull($request, 'search', 'contract_in_months'))
            ->setLimit($request->limit)
            ->setDirection($request->direction)
            ->setOrderBy($request->order_by)
            ->setPage($request->page);
    }
}
