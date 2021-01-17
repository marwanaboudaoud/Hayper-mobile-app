<?php


namespace App\Src\Mappers\Request\Partner;

use App\Http\Requests\Partner\PartnerStoreRequest;
use App\Src\Models\Hyper\Partner\PartnerModel;

class PartnerRequestStoreMapper
{
    /**
     * @param  PartnerStoreRequest $partnerStoreRequest
     * @return PartnerModel
     */
    public static function toPartnerModel(PartnerStoreRequest $partnerStoreRequest)
    {
        return (new PartnerModel())
            ->setName($partnerStoreRequest->name)
            ->setAddress($partnerStoreRequest->address)
            ->setHouseNumber($partnerStoreRequest->house_number)
            ->setPostcode($partnerStoreRequest->postcode)
            ->setCity($partnerStoreRequest->city)
            ->setPhone($partnerStoreRequest->phone);
    }
}
