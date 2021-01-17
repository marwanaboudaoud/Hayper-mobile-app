<?php


namespace App\Src\Mappers\Hyper\Address;

use App\Address;
use App\Src\Models\Hyper\Address\AddressModel;

class AddressModelMapper
{
    public static function toArray(?AddressModel $addressModel)
    {
        return $addressModel ? [
            'id' => $addressModel->getId(),
            'street' => $addressModel->getStreet(),
            'house_number' => $addressModel->getHouseNumber(),
            'addition' => $addressModel->getAddition(),
            'postcode' => $addressModel->getPostcode(),
            'city' => $addressModel->getCity(),
            'is_active' => $addressModel->isActive(),
            'user_id' => $addressModel->getUser()
        ] : [];
    }

    public static function toEloquentModel(AddressModel $address)
    {
        $addressModel = new Address();
        $addressModel->id = $address->getId();
        $addressModel->street = $address->getStreet();
        $addressModel->house_number = $address->getHouseNumber();
        $addressModel->addition = $address->getAddition();
        $addressModel->postcode = $address->getPostcode();
        $addressModel->city = $address->getCity();
        $addressModel->is_active = $address->isActive();
        $addressModel->user_id = $address->getUser();

        return $addressModel;
    }
}
