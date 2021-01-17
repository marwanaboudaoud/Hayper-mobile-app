<?php


namespace App\Src\Mappers\Request\Schedule;

use App\Src\Models\Hyper\User\UserModel;
use Illuminate\Support\Collection;

class ScheduleEmployeeRequestStoreMapper
{
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(
            function ($id) {
                return self::toModel($id);
            }
        );
    }

    public static function toModel(int $id)
    {
        return (new UserModel())
            ->setId($id);
    }
}
