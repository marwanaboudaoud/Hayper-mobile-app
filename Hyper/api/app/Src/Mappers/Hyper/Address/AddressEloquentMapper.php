<?php


namespace App\Src\Mappers\Hyper\Address;

use App\Address;
use App\Src\Models\Hyper\Address\AddressModel;

class AddressEloquentMapper
{
    public static function toAddressModel(Address $address)
    {
        return (new AddressModel())
            ->setId($address->id)
            ->setStreet($address->street)
            ->setHouseNumber($address->house_number)
            ->setAddition($address->addition)
            ->setPostcode($address->postcode)
            ->setCity($address->city)
            ->setActive($address->is_active)
            ->setUser($address->user_id);
    }
}
