<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryTotalPerDayModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryTotalPerDayStdMapper
{
    public static function toModelCollection(Collection $collection)
    {
        return $collection->map(function (\stdClass $item) {
            return self::toModel($item);
        });
    }

    public static function toModel(\stdClass $stdClass)
    {
        return (new SalaryTotalPerDayModel())
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $stdClass->date)
            )
            ->setId($stdClass->id)
            ->setSalary($stdClass->total_sales);
    }
}
