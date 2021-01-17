<?php


namespace App\Src\Mappers\Hyper\Partner;

use App\Partner;

use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Partner\PartnerModel;

class PartnerModelMapper
{
    /**
     * @param PartnerModel $partnerModel
     */
    public static function toEloquentModel(PartnerModel $partnerModel)
    {
        $partner = new Partner();
        $partner->name = $partnerModel->getName();
        $partner->address = $partnerModel->getAddress();
        $partner->house_number = $partnerModel->getHouseNumber();
        $partner->postcode = $partnerModel->getPostcode();
        $partner->city = $partnerModel->getCity();
        $partner->phone = $partnerModel->getPhone();

        return $partner;
    }

    public static function toArray(PartnerModel $partnerModel)
    {
        return [
            'id' => $partnerModel->getId(),
            'name' => $partnerModel->getName(),
            'address' => $partnerModel->getAddress(),
            'house_number' => $partnerModel->getHouseNumber(),
            'postcode' => $partnerModel->getPostcode(),
            'city' => $partnerModel->getCity(),
            'phone' => $partnerModel->getPhone()
        ];
    }

    public static function toEloquentUpdateModel(PartnerModel $orgModel, PartnerModel $updateModel)
    {
        $partner = new Partner();
        $partner->id = $orgModel->getId();
        $partner->name = $updateModel->getName() ?? $orgModel->getName();
        $partner->address = $updateModel->getAddress() ?? $orgModel->getAddress();
        $partner->postcode = $updateModel->getPostcode() ?? $orgModel->getPostcode();
        $partner->city = $updateModel->getCity() ?? $orgModel->getCity();
        $partner->phone = $updateModel->getPhone() ?? $orgModel->getPhone();
        $partner->house_number = $updateModel->getHouseNumber() ?? $orgModel->getHouseNumber();

        return $partner;
    }
}
