<?php


namespace App\Src\Mappers\Request\Salary;

use App\Http\Requests\Salary\MySalaryRequest;
use App\Src\Models\Hyper\Salary\MySalaryModel;
use Carbon\Carbon;

class MySalaryRequestMapper
{
    /**
     * @param MySalaryRequest $request
     * @return MySalaryModel
     */
    public static function toModel(MySalaryRequest $request)
    {
        return (new MySalaryModel())
            ->setStartDate(
                Carbon::createFromFormat('Y-m-d', $request->start_date)
            )
            ->setEndDate(
                Carbon::createFromFormat('Y-m-d', $request->end_date)
            )
            ->setApiToken(
                $request->header('api-key')
            );
    }
}
