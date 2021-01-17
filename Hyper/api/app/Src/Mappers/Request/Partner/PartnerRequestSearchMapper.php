<?php


namespace App\Src\Mappers\Request\Partner;

use App\Http\Requests\Pagination\PartnerPaginationRequest;
use App\Src\Mappers\Request\Pagination\PaginationRequestMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;

class PartnerRequestSearchMapper
{
    /**
     * @param  PartnerPaginationRequest $partnerRequest
     * @return PaginationPartnerModel
     */
    public static function toPartnerModel(PartnerPaginationRequest $partnerRequest)
    {
        return (new PaginationPartnerModel())
            ->setPage($partnerRequest->page)
            ->setLimit($partnerRequest->limit)
            ->setOrderBy($partnerRequest->order_by)
            ->setDirection($partnerRequest->direction)
            ->setPartner(
                (new PartnerModel())
                    ->setId((int)keyExistOrNull($partnerRequest, 'search', 'id'))
                    ->setName(keyExistOrNull($partnerRequest, 'search', 'name'))
                    ->setAddress(keyExistOrNull($partnerRequest, 'search', 'address'))
                    ->setHouseNumber(keyExistOrNull($partnerRequest, 'search', 'house_number'))
                    ->setPostcode(keyExistOrNull($partnerRequest, 'search', 'postcode'))
                    ->setCity(keyExistOrNull($partnerRequest, 'search', 'city'))
                    ->setPhone(keyExistOrNull($partnerRequest, 'search', 'phone'))
            );
    }
}
