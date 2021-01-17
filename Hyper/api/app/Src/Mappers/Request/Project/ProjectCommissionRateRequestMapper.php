<?php


namespace App\Src\Mappers\Request\Project;

use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use Illuminate\Support\Collection;

class ProjectCommissionRateRequestMapper
{
    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function (\stdClass $item) {
            return self::toModel($item);
        });
    }

    /**
     * @param \stdClass $class
     * @return CommissionRateModel
     */
    public static function toModel(\stdClass $class)
    {
        return (new CommissionRateModel())
            ->setRate($class->rate)
            ->setAmount($class->amount)
            ->setRoleId($class->role_id);
    }
}
