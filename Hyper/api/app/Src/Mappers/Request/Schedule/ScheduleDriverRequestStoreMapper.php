<?php


namespace App\Src\Mappers\Request\Schedule;

use App\Src\Models\Hyper\User\UserModel;

class ScheduleDriverRequestStoreMapper
{
    public static function toModel($id)
    {
        return (new UserModel())
            ->setId($id);
    }
}
