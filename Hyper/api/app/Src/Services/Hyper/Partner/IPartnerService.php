<?php


namespace App\Src\Services\Hyper\Partner;

use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;

interface IPartnerService
{
    public function store(PartnerModel $partnerModel);

    public function get(PaginationPartnerModel $paginationPartnerModel);

    public function find(int $id);

    public function update(int $id, PartnerModel $partnerModel);

    public function delete($id);
}
