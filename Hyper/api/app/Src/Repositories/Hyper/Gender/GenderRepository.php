<?php


namespace App\Src\Repositories\Hyper\Gender;

use App\Gender;
use App\Src\Mappers\Hyper\Gender\GenderEloquentMapper;

class GenderRepository implements IGenderRepository
{

    /**
     * @inheritDoc
     */
    public function get()
    {
        $genders = Gender::all();
        return GenderEloquentMapper::toCollection($genders);
    }
}
