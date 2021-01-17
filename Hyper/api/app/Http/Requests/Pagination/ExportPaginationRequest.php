<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Pagination\PaginationRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class ExportPaginationRequest extends PaginationRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_by' => 'string',
            'direction' => 'string',
        ];
    }

    /**
     * @return \App\Src\Models\Hyper\Pagination\PaginationModel
     */
    public function map()
    {
        $this->limit = 1000;
        $this->page = 1;

        return PaginationRequestMapper::toModel($this);
    }
}
