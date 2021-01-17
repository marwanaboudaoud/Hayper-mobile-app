<?php

namespace App\Http\Requests\Pagination;

use App\Src\Mappers\Request\Role\RoleRequestSearchMapper;
use Illuminate\Foundation\Http\FormRequest;

class RolePaginationRequest extends FormRequest
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
            'id' => 'int',
            'title' => 'string',
            'code_in_nmbrs' => 'int',
        ];
    }

    public function map()
    {
        return RoleRequestSearchMapper::toRoleModel($this);
    }
}
