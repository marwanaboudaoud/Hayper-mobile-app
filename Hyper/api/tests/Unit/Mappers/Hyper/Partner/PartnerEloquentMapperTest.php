<?php

namespace Tests\Unit\Mappers\Hyper\Project;

use App\Partner;
use App\Src\Mappers\Hyper\Partner\PartnerEloquentMapper;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Support\Collection;
use Tests\TestCase;

class PartnerEloquentMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToCollection()
    {
        $partner = factory(Partner::class, 3)->make();

        $partner = PartnerEloquentMapper::toCollectionModel($partner);

        $this->assertInstanceOf(Collection::class, $partner);
    }

    public function testToModel()
    {
        $partner = factory(Partner::class)->make();

        $partner = PartnerEloquentMapper::toModel($partner);

        $this->assertInstanceOf(PartnerModel::class, $partner);
    }

}
