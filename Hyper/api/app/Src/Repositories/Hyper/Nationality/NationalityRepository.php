<?php


namespace App\Src\Repositories\Hyper\Nationality;

use App\Nationality;
use App\Src\Mappers\Hyper\Nationality\NationalityEloquentMapper;

class NationalityRepository implements INationalityRepository
{

    public function get()
    {
        $nationalities = Nationality::orderBy('name', 'asc')->get();
        return NationalityEloquentMapper::toCollection($nationalities);
    }
}
