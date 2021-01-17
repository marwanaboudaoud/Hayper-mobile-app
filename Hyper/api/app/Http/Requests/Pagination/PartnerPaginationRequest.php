<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Partner\PartnerRequestSearchMapper;
use Illuminate\Foundation\Http\FormRequest;

class PartnerPaginationRequest extends PaginationRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id' => 'int',
            'name' => 'string',
            'address' => 'string',
            'house_number' => 'int',
            'postcode' => 'string',
            'city' => 'string',
            'phone' => 'string'
        ];
        return array_merge(parent::rules(), $rules);
    }


    public function map()
    {
        return PartnerRequestSearchMapper::toPartnerModel($this);
    }
}
