<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Project\ProjectRequestSearchMapper;
use Illuminate\Foundation\Http\FormRequest;

class ProjectPaginationRequest extends PaginationRequest
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
            'name' => 'string',
            'is_active' => 'int',
            'partner_id' => 'string'
        ];
        return array_merge(parent::rules(), $rules);
    }

    public function map()
    {
        return ProjectRequestSearchMapper::toModel($this);
    }
}
