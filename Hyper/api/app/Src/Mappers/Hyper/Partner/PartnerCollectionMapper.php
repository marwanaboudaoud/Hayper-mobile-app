<?php


namespace App\Src\Mappers\Hyper\Partner;

use Illuminate\Support\Collection;

class PartnerCollectionMapper
{
    public static function toArray(Collection $collection)
    {
        return $collection->map(
            function ($item) {
                return [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'address' => $item->getAddress(),
                'house_number' => $item->getHouseNumber(),
                'postcode' => $item->getPostcode(),
                'city' => $item->getCity(),
                'phone' => $item->getPhone(),
                ];
            }
        );
    }
}
