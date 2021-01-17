<?php


namespace App\Src\Mappers\Request\Salary;

use App\Http\Requests\Salary\SalaryManualStoreRequest;
use App\Src\Models\Hyper\Salary\SalaryManualModel;
use Carbon\Carbon;

class SalaryManualStoreRequestMapper
{
    /**
     * @param SalaryManualStoreRequest $request
     * @return SalaryManualModel
     */
    public static function toModel(SalaryManualStoreRequest $request)
    {
        return (new SalaryManualModel())
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $request->date)
            )
            ->setDescription($request->description)
            ->setPrice($request->price);
    }
}
