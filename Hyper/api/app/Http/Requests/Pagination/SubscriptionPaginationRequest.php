<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Subscription\SubscriptionRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPaginationRequest extends PaginationRequest
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
            'id' => 'string',
            'project' => 'string',
            'code' => 'string',
            'duration_in_months' => 'string',
            'title' => 'string',
        ];

        return array_merge($rules, parent::rules());
    }

    public function map()
    {
        return SubscriptionRequestMapper::toModel($this);
    }
}
