<?php

namespace App;

use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Partner extends Model
{

    public function scopeId($query, $id)
    {
        $id ? $query->where('id', $id) : null;
    }

    /**
     * @param  $query
     * @param  $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        $name ? $query->where('name', 'LIKE', '%' . $name . '%') : null;
    }

    /**
     * @param  $query
     * @param  $house_number
     * @return mixed
     */
    public function scopeHouseNumber($query, $house_number)
    {
        $house_number ? $query->where('house_number', 'LIKE', '%' . $house_number . '%') : null;
    }

    /**
     * @param  $query
     * @param  $address
     * @return mixed
     */
    public function scopeAddress($query, $address)
    {
        $address ? $query->where('address', 'LIKE', '%' . $address . '%') : null;
    }

    /**
     * @param $query
     * @param $postcode
     */
    public function scopePostcode($query, $postcode)
    {
        $postcode ? $query->where('postcode', 'LIKE', '%' . $postcode . '%') : null;
    }

    /**
     * @param $query
     * @param $city
     */
    public function scopeCity($query, $city)
    {
        $city ? $query->where('city', 'LIKE', '%' . $city . '%') : null;
    }

    /**
     * @param $query
     * @param $phone
     */
    public function scopePhone($query, $phone)
    {
        $phone ? $query->where('phone', 'LIKE', '%' . $phone . '%') : null;
    }


    /**
     * @param  $query
     * @param PaginationPartnerModel $paginationPartnerModel
     * @return mixed
     */
    public function scopeSearch($query, PaginationPartnerModel $paginationPartnerModel)
    {
        $partnerModel = $paginationPartnerModel->getPartner();

        $query->Name($partnerModel->getName())
            ->Id($partnerModel->getId())
            ->HouseNumber($partnerModel->getHouseNumber())
            ->Address($partnerModel->getAddress())
            ->Postcode($partnerModel->getPostcode())
            ->City($partnerModel->getCity())
            ->Phone($partnerModel->getPhone());

        if ($paginationPartnerModel->getOrderBy() && $paginationPartnerModel->getDirection()) {
            $query->orderBy(
                $paginationPartnerModel->getOrderBy(),
                $paginationPartnerModel->getDirection()
            );
        }

        if ($paginationPartnerModel->getLimit()) {
            $query->limit($paginationPartnerModel->getLimit())
                ->offset(
                    $paginationPartnerModel->getLimit() *
                    ($paginationPartnerModel->getPage() - 1)
                );
        }

        return $query;
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'id');
    }
}
