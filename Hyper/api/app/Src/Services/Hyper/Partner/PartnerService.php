<?php


namespace App\Src\Services\Hyper\Partner;

use App\Exceptions\Partner\PartnerNotFoundException;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;

class PartnerService implements IPartnerService
{
    /**
     * @var IPartnerRepository
     */
    protected $partnerRepository;

    public function __construct(IPartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * @param PaginationPartnerModel $paginationPartnerModel
     * @return mixed
     */
    public function get(PaginationPartnerModel $paginationPartnerModel)
    {
        return $this->partnerRepository->get($paginationPartnerModel);
    }

    /**
     * @param PartnerModel $partnerModel
     */
    public function store(PartnerModel $partnerModel)
    {
        return $this->partnerRepository->store($partnerModel);
    }

    /**
     * @param  $id
     * @return mixed
     * @throws PartnerNotFoundException
     */
    public function find(int $id)
    {
        $partner = $this->partnerRepository->findById($id);

        if (!$partner) {
            throw new PartnerNotFoundException();
        }

        return $partner;
    }

    public function update(int $id, PartnerModel $partnerModel)
    {
        $partner = $this->partnerRepository->findById($id);

        if (!$partner) {
            throw new PartnerNotFoundException();
        }



        return $this->partnerRepository->update($id, $partnerModel);
    }

    public function delete($id)
    {
        $partner = $this->partnerRepository->findById($id);
        if (!$partner) {
            throw new PartnerNotFoundException();
        }
        return $this->partnerRepository->delete($id);
    }
}
