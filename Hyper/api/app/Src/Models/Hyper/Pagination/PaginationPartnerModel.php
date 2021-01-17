<?php


namespace App\Src\Models\Hyper\Pagination;

use App\Src\Models\Hyper\Partner\PartnerModel;

class PaginationPartnerModel extends PaginationModel
{
    /**
     * @var ?PartnerModel
     */
    private $partner;

    /**
     * @return PartnerModel
     */
    public function getPartner(): ?PartnerModel
    {
        return $this->partner;
    }

    /**
     * @param PartnerModel $partner
     * @return PaginationPartnerModel
     */
    public function setPartner(?PartnerModel $partner): PaginationPartnerModel
    {
        $this->partner = $partner;

        return $this;
    }
}
