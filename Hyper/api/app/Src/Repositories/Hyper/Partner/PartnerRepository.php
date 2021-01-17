<?php


namespace App\Src\Repositories\Hyper\Partner;

use App\Exceptions\Partner\PartnerNotFoundException;
use App\Partner;
use App\Project;
use App\Src\Mappers\Hyper\Partner\PartnerCollectionMapper;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Mappers\Hyper\Partner\PartnerModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Models\Hyper\Pagination\PaginationPartnerModel;
use App\Src\Models\Hyper\Partner\PartnerModel;

class PartnerRepository implements IPartnerRepository
{
    /**
     * @param PaginationPartnerModel $paginationPartnerModel
     * @return PaginationModel
     */
    public function get(PaginationPartnerModel $paginationPartnerModel)
    {
        $limit = $paginationPartnerModel->getLimit();

        $partnerEloquent = Partner::Search($paginationPartnerModel)->get();
        $partnerCount = Partner::Search($paginationPartnerModel->setLimit(null))->count();

        $models = PartnerEloquentMapper::toCollectionModel($partnerEloquent);

        return $paginationPartnerModel->setLimit($limit)
            ->setItems($models)
            ->setTotalItems($partnerCount);
    }

    /**
     * @param  PartnerModel $partnerModel
     * @return PartnerModel
     */
    public function store(PartnerModel $partnerModel)
    {
        $partner = PartnerModelMapper::toEloquentModel($partnerModel);
        $partner->save();
        return PartnerEloquentMapper::toPartnerModel($partner);
    }

    /**
     * @param  $attr
     * @param  $arg
     * @param  bool $eloquentModel
     * @return PartnerModel|null
     */
    public function findBy($attr, $arg, bool $eloquentModel = false)
    {
        $partner = Partner::where($attr, $arg)->first();

        if (!$partner) {
            return null;
        }

        if ($eloquentModel) {
            return $partner;
        }

        return PartnerEloquentMapper::toPartnerModel($partner);
    }

    /**
     * @param  $id
     * @param  bool $eloquentModel
     * @return PartnerModel|null
     */
    public function findById($id, bool $eloquentModel = false)
    {
        return $this->findBy('id', $id, $eloquentModel);
    }

    /**
     * @param  $id
     * @param  PartnerModel $partnerModel
     * @return PartnerModel
     */
    public function update($id, PartnerModel $partnerModel)
    {
        $foundPartner = $this->findById($id);

        $updatePartner = PartnerModelMapper::toEloquentUpdateModel($foundPartner, $partnerModel);
        $updatePartner->exists = true;
        $updatePartner->save();

        return PartnerEloquentMapper::toPartnerModel($updatePartner);
    }

    /**
     * @param  int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $foundPartner = Partner::find($id);

        if (!$foundPartner) {
            false;
        }

        $foundPartner->projects()->delete();
        $foundPartner->delete();

        return true;
    }
}
