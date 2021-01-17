<?php


namespace App\Src\Mappers\Hyper\Salary;

use App\Src\Models\Hyper\Salary\SalaryDayModel;
use App\Src\Models\Hyper\Salary\SalaryManualModel;
use App\Src\Models\Hyper\Salary\SalaryRowModel;

class SalaryManualModelMapper
{
    /**
     * @param SalaryManualModel $model
     * @return SalaryDayModel
     */
    public static function toSalaryDayModel(SalaryManualModel $model)
    {
        $row = (new SalaryRowModel())->setPrice($model->getPrice())
            ->setDescription($model->getDescription())
            ->setAmount(1);

        return (new SalaryDayModel())
            ->setDate($model->getDate())
            ->setRows(
                collect([$row])
            );
    }

    /**
     * @param SalaryManualModel $model
     * @return array
     */
    public static function toArray(SalaryManualModel $model)
    {

        return [
            'description' => $model->getDescription(),
            'price' => $model->getPrice(),
            'date' => $model->getDate()->toDateString()
        ];
    }
}
