<?php


namespace App\Src\Mappers\Hyper\Project;

use App\Project;
use App\Schedule;
use App\Src\Mappers\Hyper\CommissionRate\CommissionRateModelMapper;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Mappers\Hyper\Partner\PartnerModelMapper;
use App\Src\Mappers\Hyper\Schedule\ScheduleModelMapper;
use App\Src\Models\Hyper\Project\ProjectModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Repositories\Hyper\Partner\PartnerRepository;
use App\Src\Services\Hyper\Partner\PartnerService;
use Illuminate\Support\Collection;

class ProjectModelMapper
{
    public static function toEloquentModel(ProjectModel $projectModel)
    {
        $model = new Project();
        $model->name = $projectModel->getName();
        $model->is_active = $projectModel->isActive();
        $model->partner_id = $projectModel->getPartnerId();

        return $model;
    }

    public static function toCollectionArray(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toArray($item);
            }
        );
    }

    public static function toArray(ProjectModel $projectModel)
    {
        $partner = null;
        $partnerObj = $projectModel->getPartner();

        if ($partnerObj) {
            $partner = PartnerModelMapper::toArray($partnerObj);
        }

        return [
            'id' => $projectModel->getId(),
            'name' => $projectModel->getName(),
            'is_active' => $projectModel->isActive(),
            'partner_id' => $projectModel->getPartnerId(),
            'schedules' => ScheduleModelMapper::toCollectionArray($projectModel->getSchedules()),
            'commission_rates' => CommissionRateModelMapper::toCollectionArray($projectModel->getCommissionRates()),
            'partner' => $partner,
            'partner_name' => $partnerObj ? $partnerObj->getName() : null
        ];
    }

    public static function toEloquentUpdateModel(ProjectModel $oldModel, ProjectModel $newModel)
    {
        $model = new Project();
        $model->exists = true;
        $model->id = $oldModel->getId();
        $model->name = $newModel->getName() ?? $oldModel->getName();
        $model->is_active = $newModel->isActive() ?? $oldModel->isActive();
        $model->partner_id = $newModel->getPartnerId() ?? $oldModel->getPartnerId();

        return $model;
    }
}
