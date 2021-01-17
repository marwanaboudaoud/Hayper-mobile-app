<?php


namespace App\Src\Mappers\Hyper\Score;

use App\Src\Models\Hyper\Score\ScoreModel;

class ScoreModelMapper
{
    public static function toArray(ScoreModel $model)
    {
        return [
            'total_shifts' => $model->getTotalShifts()
        ];
    }
}
