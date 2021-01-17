<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\SalaryRow;
use App\Src\Models\Hyper\Salary\SalaryRowModel;
use Illuminate\Support\Collection;

class SalaryRowModelMapper
{
    public static function toCollectionArray(Collection $collection)
    {
        if ($collection->count() === 0) {
            return [];
        }

        return $collection->map(function (SalaryRowModel $salaryRowModel) {
            return self::toArray($salaryRowModel);
        })->toArray();
    }

    public static function toArray(SalaryRowModel $salaryRowModel)
    {
        return [
            'description' => $salaryRowModel->getDescription(),
            'underline_description' => $salaryRowModel->getUnderlineDescription(),
            'is_bonus' => $salaryRowModel->isBonus(),
            'amount' => $salaryRowModel->getAmount(),
            'price' => $salaryRowModel->getPrice(),
        ];
    }

    /**
     * @param SalaryRowModel $salaryRowModel
     * @return SalaryRow
     */
    public static function toEloquentModel(SalaryRowModel $salaryRowModel)
    {
        $model = new SalaryRow();
        $model->description = $salaryRowModel->getDescription();
        $model->amount = $salaryRowModel->getAmount();
        $model->price = $salaryRowModel->getPrice();
        $model->is_bonus = $salaryRowModel->isBonus();
        $model->salary_day_id = $salaryRowModel->getSalaryDayId();

        return $model;
    }
}
