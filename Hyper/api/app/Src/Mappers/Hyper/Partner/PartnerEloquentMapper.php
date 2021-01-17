<?php


namespace App\Src\Mappers\Hyper\Partner;

use App\Partner;
use App\Src\Models\Hyper\Partner\PartnerModel;
use Illuminate\Support\Collection;

class PartnerEloquentMapper
{
    public static function toCollectionPartnerModel(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return self::toPartnerModel($item);
            }
        );
    }

    public static function toPartnerModel(Partner $partner)
    {
        return (new PartnerModel())
            ->setId($partner->id)
            ->setName($partner->name)
            ->setAddress($partner->address)
            ->setHouseNumber($partner->house_number)
            ->setPostcode($partner->postcode)
            ->setCity($partner->city)
            ->setPhone($partner->phone);
    }

    public static function toCollectionModel(Collection $collection)
    {
        return $collection->map(function ($item) {
            return self::toModel($item);
        });
    }

    public static function toModel(?Partner $partner)
    {
        if (!$partner) {
            return null;
        }

        return (new PartnerModel())
            ->setId($partner->id)
            ->setCity($partner->city)
            ->setPostcode($partner->postcode)
            ->setAddress($partner->address)
            ->setName($partner->name)
            ->setPhone($partner->phone)
            ->setHouseNumber($partner->house_number);
    }
}
