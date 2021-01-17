<?php

namespace Tests\Unit\Mappers\Request;

use App\Http\Requests\Pagination\PaginationRequest;
use App\Src\Mappers\Request\Pagination\PaginationRequestMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaginationRequestMapperTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testToModel()
    {
        $request = new PaginationRequest();
        $request->merge([
            'limit' => 10,
            'page' => 1,
            'order_by' => 'id',
            'direction' => 'asc'
        ]);

        $result = PaginationRequestMapper::toModel($request);
        $this->assertInstanceOf(PaginationModel::class, $result);
        $this->assertEquals(10, $result->getLimit());
        $this->assertEquals(1, $result->getPage());
        $this->assertEquals('id', $result->getOrderBy());
        $this->assertEquals('asc', $result->getDirection());
    }

    public function testValidationRules()
    {
        $request = new PaginationRequest();

        $this->assertEquals([
            'limit' => 'int|required',
            'page' => 'int|required',
            'order_by' => 'string',
            'direction' => 'string'
        ], $request->rules());
    }
}
