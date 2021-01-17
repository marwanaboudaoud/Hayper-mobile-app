<?php

namespace App\Src\Mappers\Hyper\Pagination;

use App\Src\Models\Hyper\Pagination\PaginationEmployeeModel;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use Illuminate\Support\Str;

class PaginationModelMapper
{
    public static function toArray(
        PaginationModel $paginationModel,
        IPaginationCollectionModelMapper $IPaginationCollectionModelMapper
    ) {
        return [
            'page' => $paginationModel->getPage(),
            'total_pages' => $paginationModel->getTotalPages(),
            'limit' => $paginationModel->getLimit(),
            'results' => $IPaginationCollectionModelMapper::toCollectionArray(
                $paginationModel->getItems()
            ),
            'total_items' => $paginationModel->getTotalItems()
        ];
    }

    /**
     * @param PaginationModel $paginationModel
     * @return PaginationEmployeeModel
     */
    public static function toPaginationEmployeeModel(PaginationModel $paginationModel)
    {
        $object = (new PaginationEmployeeModel())
            ->setLimit(1000)
            ->setOrderBy($paginationModel->getOrderBy())
            ->setDirection($paginationModel->getDirection())
            ->setEmployee($paginationModel->getEmployee());

        return $object;
    }
}
