<?php


namespace App\Src\Mappers\Request\Subscription;

use App\Http\Requests\Pagination\SubscriptionPaginationRequest;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\SubscriptionPaginationModel;

class SubscriptionRequestMapper
{
    /**
     * @param SubscriptionPaginationRequest $subscriptionPaginationRequest
     * @return SubscriptionPaginationModel
     */
    public static function toModel(SubscriptionPaginationRequest $subscriptionPaginationRequest)
    {
        return (new SubscriptionPaginationModel())
            ->setId(keyExistOrNull($subscriptionPaginationRequest, 'search', 'id'))
            ->setProject(keyExistOrNull($subscriptionPaginationRequest, 'search', 'project'))
            ->setCode(keyExistOrNull($subscriptionPaginationRequest, 'search', 'code'))
            ->setTitle(keyExistOrNull($subscriptionPaginationRequest, 'search', 'title'))
            ->setDurationInMonths(
                keyExistOrNull($subscriptionPaginationRequest, 'search', 'duration_in_months')
            )->setPage($subscriptionPaginationRequest->page)
            ->setLimit($subscriptionPaginationRequest->limit)
            ->setOrderBy($subscriptionPaginationRequest->order_by)
            ->setDirection($subscriptionPaginationRequest->direction);
    }
}
