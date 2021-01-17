<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\Salary;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Mappers\Hyper\User\UserEloquentMapper;
use App\Src\Models\Hyper\Salary\SalaryModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryEloquentMapper
{
    /**
     * @param Salary $salary
     * @return SalaryModel
     */
    public static function toModel(Salary $salary)
    {
        // $is_closed = $salary->is_closed === false ? false : true;
        return (new SalaryModel())
            ->setId($salary->id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $salary->date)
            )
            ->setEmployee(
                UserEloquentMapper::toUserModel($salary->employee)
            )
            ->setDescription($salary->description)
            ->setHeading($salary->heading)
            ->setTotalSalary($salary->salary)
            ->setClosed($salary->is_closed)
            ->setSalaryDays(
                SalaryDayEloquentMapper::toCollectionModel($salary->salaryDays)
            )
            ->setSalaryManual(
                SalaryManualEloquentMapper::toCollectionModel($salary->salaryManual)
            );
    }

    /**
     * @param Collection $salaries
     * @return Collection
     */
    public static function toCollectionModel(Collection $salaries)
    {
        return $salaries->map(function (Salary $salary) {
            return self::toModel($salary);
        });
    }
}
