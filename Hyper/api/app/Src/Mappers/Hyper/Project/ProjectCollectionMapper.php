<?php


namespace App\Src\Mappers\Hyper\Project;

use App\Src\Models\Hyper\Partner\PartnerModel;
use Illuminate\Support\Collection;

class ProjectCollectionMapper
{
    /**
     * @param Collection $collection
     * @return Collection
     */
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
                ];
            }
        );
    }
}
