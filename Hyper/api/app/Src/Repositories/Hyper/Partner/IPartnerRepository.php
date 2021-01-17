<?php


namespace App\Src\Repositories\Hyper\Partner;

use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;

interface IPartnerRepository
{
    public function store(PartnerModel $partnerModel);

    public function get(PaginationPartnerModel $partnerModel);

    public function findById($id, bool $eloquentModel = false);

    public function update($id, PartnerModel $partnerModel);

    public function delete(int $id);
}
