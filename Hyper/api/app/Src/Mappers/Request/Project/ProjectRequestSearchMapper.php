<?php


namespace App\Src\Mappers\Request\Project;

use App\Http\Requests\Pagination\ProjectPaginationRequest;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Pagination\PaginationProjectModel;
use App\Src\Models\Hyper\Project\ProjectModel;

class ProjectRequestSearchMapper
{
    /**
     * @param ProjectPaginationRequest $paginationRequest
     * @return PaginationProjectModel
     */
    public static function toModel(ProjectPaginationRequest $paginationRequest)
    {
        return (new PaginationProjectModel())
            ->setPage($paginationRequest->page)
            ->setLimit($paginationRequest->limit)
            ->setOrderBy($paginationRequest->order_by)
            ->setDirection($paginationRequest->direction)
            ->setProject(
                (new ProjectModel())
                    ->setId((int)keyExistOrNull($paginationRequest, 'search', 'id'))
                    ->setName(keyExistOrNull($paginationRequest, 'search', 'name'))
                    ->setActive(keyExistOrNull($paginationRequest, 'search', 'active'))
                    ->setPartnerId(keyExistOrNull($paginationRequest, 'search', 'partner_id'))
            );
    }
}
