<?php


namespace App\Src\Mappers\Hyper\Project;

use App\Project;
use App\Src\Mappers\Hyper\CommissionRate\CommissionRateEloquentModelMapper;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Mappers\Hyper\Schedule\ScheduleEloquentMapper;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;

class ProjectEloquentMapper
{
    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toModel($item);
            }
        );
    }

    public static function toModel(?Project $project)
    {
        $partner = null;

        if ($project->partner) {
            $partner = PartnerEloquentMapper::toModel($project->partner);
        }

        return (new ProjectModel())
            ->setId($project->id)
            ->setName($project->name)
            ->setActive(boolval($project->is_active))
            ->setPartnerId($project->partner_id)
            ->setSchedules(
                ScheduleEloquentMapper::toCollectionModel($project->schedules)
            )
            ->setPartner($partner)
            ->setCommissionRates(
                CommissionRateEloquentModelMapper::toCollectionModel($project->commissionRates)
            );
    }
}
