<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\SalaryDay;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Models\Hyper\Salary\SalaryDayModel;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SalaryDayEloquentMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (SalaryDay $item) {
            return self::toModel($item);
        });
    }

    public static function toModel(?SalaryDay $salaryDay)
    {
        if (!$salaryDay) {
            return null;
        }

        return (new SalaryDayModel())
            ->setId($salaryDay->id)
            ->setDate(
                Carbon::createFromFormat('Y-m-d', $salaryDay->date)
            )
            ->setHasDriven($salaryDay->has_driven)
            ->setIsManual($salaryDay->is_manual)
            ->setSalaryId($salaryDay->salary_id)
            ->setRows(
                SalaryRowEloquentMapper::toCollectionModel($salaryDay->salaryRows)
            )
            ->setPartner(
                PartnerEloquentMapper::toModel($salaryDay->partner)
            );
    }
}
