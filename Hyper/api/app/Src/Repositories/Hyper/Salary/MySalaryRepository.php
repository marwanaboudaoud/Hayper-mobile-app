<?php

 namespace App\Src\Repositories\Hyper\Salary;

use App\Salary;
use App\Src\Mappers\Hyper\Salary\SalaryEloquentMapper;
use App\Src\Models\Hyper\Salary\MySalaryModel;

class MySalaryRepository implements IMySalaryRepository
{
    public function get(MySalaryModel $mySalaryModel)
    {
        $startDate = $mySalaryModel->getStartDate()->toDateString();
        $endDate = $mySalaryModel->getEndDate()->toDateString();

        $salaryDaysCallback = function ($query) use ($startDate, $endDate) {
            $query->with('salaryRows')
                ->whereBetween('date', [$startDate, $endDate]);
        };

        $salaries = Salary::whereHas('employee', function ($query) use ($mySalaryModel, $startDate, $endDate) {
                $query->where('api_token', $mySalaryModel->getApiToken());
        })->whereHas('salaryDays', $salaryDaysCallback)
            ->with(['salaryDays' => $salaryDaysCallback])
            ->get();

        return SalaryEloquentMapper::toCollectionModel($salaries);
    }
}
