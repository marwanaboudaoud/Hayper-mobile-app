<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Contract\ContractSearchRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class ContractSearchRequest extends PaginationRequest
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
        $rules = [
            'id' => 'int',
            'start_date' => 'string',
            'end_date' => 'string',
            'employee_name' => 'string',
            'contract_in_months' => 'string'
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function map()
    {
        return ContractSearchRequestMapper::toModel($this);
    }
}
