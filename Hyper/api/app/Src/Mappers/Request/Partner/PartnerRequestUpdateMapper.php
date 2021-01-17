<?php


namespace App\Src\Mappers\Request\Partner;

use App\Http\Requests\Partner\PartnerUpdateRequest;
use App\Src\Models\Hyper\Partner\PartnerModel;

class PartnerRequestUpdateMapper
{
    public static function toPartnerModel(PartnerUpdateRequest $partnerUpdateRequest)
    {
        return (new PartnerModel())
            ->setName($partnerUpdateRequest->name)
            ->setAddress($partnerUpdateRequest->address)
            ->setHouseNumber($partnerUpdateRequest->house_number)
            ->setPostcode($partnerUpdateRequest->postcode)
            ->setCity($partnerUpdateRequest->city)
            ->setPhone($partnerUpdateRequest->phone);
    }
}
