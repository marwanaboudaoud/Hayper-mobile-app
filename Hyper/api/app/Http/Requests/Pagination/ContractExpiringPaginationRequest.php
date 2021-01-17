<?php

namespace App\Http\Requests\Pagination;

use Illuminate\Foundation\Http\FormRequest;

class ContractExpiringPaginationRequest extends PaginationRequest
{
    public function rules()
    {
        $rules =  parent::rules();

        unset($rules['limit']);
        unset($rules['page']);

        return $rules;
    }
}
