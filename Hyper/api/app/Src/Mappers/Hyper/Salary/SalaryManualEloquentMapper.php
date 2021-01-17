<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\SalaryDay;
use App\SalaryRow;
use App\Src\Models\Hyper\Salary\SalaryManualModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryManualEloquentMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->filter(function (SalaryDay $salaryManual) {
            return $salaryManual->salaryRows->first();
        })->map(function (SalaryDay $salaryManual) {
            $salaryRow = $salaryManual->salaryRows->first();

            return self::toModel($salaryRow);
        });
    }

    public static function toModel(SalaryRow $salaryRow)
    {
        return (new SalaryManualModel())
            ->setId($salaryRow->salary_day_id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $salaryRow->salaryDay->date)
            )
            ->setPrice($salaryRow->price)
            ->setDescription($salaryRow->description);
    }
}
