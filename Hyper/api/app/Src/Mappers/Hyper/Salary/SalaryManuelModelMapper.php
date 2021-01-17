<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryManualModel;
use Illuminate\Support\Collection;

class SalaryManuelModelMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(function (SalaryManualModel $salaryManual) {
            return self::toArray($salaryManual);
        })->toArray();
    }

    public static function toArray(SalaryManualModel $salaryManualModel)
    {
        return [
            'id' => $salaryManualModel->getId(),
            'price' => $salaryManualModel->getPrice(),
            'description' => $salaryManualModel->getDescription(),
            'date' => $salaryManualModel->getDate()->toDateString(),
        ];
    }
}
