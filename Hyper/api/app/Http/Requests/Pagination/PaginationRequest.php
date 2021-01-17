<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Pagination\PaginationRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => 'int|required',
            'page' => 'int|required',
            'order_by' => 'string',
            'direction' => 'string',
        ];
    }

    /**
     * @return \App\Src\Models\Hyper\Pagination\PaginationModel
     */
    public function map()
    {
        return PaginationRequestMapper::toModel($this);
    }
}
