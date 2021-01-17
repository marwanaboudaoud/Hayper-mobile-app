<?php


namespace App\Src\Repositories\MaritalStatus;

use App\MaritalStatus;
use App\Src\Mappers\Hyper\MaritalStatus\MaritalStatusEloquentMapper;

class MaritalStatusRepository implements IMaritalStatusRepository
{

    /**
     * @inheritDoc
     */
    public function get()
    {
        $maritalStatuses = MaritalStatus::all();
        return MaritalStatusEloquentMapper::toCollection($maritalStatuses);
    }
}
