<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\SalaryRow;
use App\Src\Models\Hyper\Salary\SalaryRowModel;

class SalaryRowEloquentDeleteMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (SalaryRow $item) {
            return self::toModel($item);
        });
    }

    public static function toModel(SalaryRow $salaryDay)
    {
        return (new SalaryRowModel())
            ->setDescription($salaryDay->description)
            ->setUnderlineDescription($salaryDay->underline_description)
            ->setAmount($salaryDay->amount)
            ->setPrice($salaryDay->price)
            ->setBonus(
                boolval($salaryDay->is_bonus)
            )
            ->setSalaryDayId($salaryDay->salaryDay->id);
    }
}
