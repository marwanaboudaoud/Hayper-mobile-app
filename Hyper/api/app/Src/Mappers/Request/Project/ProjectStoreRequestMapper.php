<?php


namespace App\Src\Mappers\Request\Project;

use App\Http\Requests\Project\ProjectStoreRequest;
use App\Src\Models\Hyper\Project\ProjectModel;

class ProjectStoreRequestMapper
{
    /**
     * @param ProjectStoreRequest $projectStoreRequest
     * @return ProjectModel
     */
    public static function toModel(ProjectStoreRequest $projectStoreRequest)
    {
        $commissionRates = collect(json_decode(json_encode($projectStoreRequest->commission_rates)));

        return (new ProjectModel())
            ->setName($projectStoreRequest->name)
            ->setActive($projectStoreRequest->is_active)
            ->setPartnerId($projectStoreRequest->partner_id)
            ->setCommissionRates(
                ProjectCommissionRateRequestMapper::toCollectionModel($commissionRates)
            );
    }
}
