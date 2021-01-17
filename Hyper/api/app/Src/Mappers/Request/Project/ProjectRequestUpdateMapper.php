<?php


namespace App\Src\Mappers\Request\Project;

use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Src\Models\Hyper\CommissionRate\CommissionRateModel;
use App\Src\Models\Hyper\Project\ProjectModel;

class ProjectRequestUpdateMapper
{
    /**
     * @param ProjectUpdateRequest $projectUpdateRequest
     * @return ProjectModel
     */
    public static function toModel(ProjectUpdateRequest $projectUpdateRequest)
    {
        $commissionRates = collect(json_decode(json_encode($projectUpdateRequest->commission_rates)));

        return (new ProjectModel())
            ->setId($projectUpdateRequest->id)
            ->setName($projectUpdateRequest->name)
            ->setActive(boolval($projectUpdateRequest->is_active))
            ->setPartnerId($projectUpdateRequest->partner_id)
            ->setCommissionRates(
                ProjectCommissionRateRequestMapper::toCollectionModel($commissionRates)
                    ->map(function (CommissionRateModel $commissionRateModel) use ($projectUpdateRequest) {
                        return $commissionRateModel->setProjectId($projectUpdateRequest->id);
                    })
            );
    }
}
