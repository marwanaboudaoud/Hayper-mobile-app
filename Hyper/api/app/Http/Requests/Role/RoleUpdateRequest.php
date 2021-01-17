<?php

namespace App\Http\Requests\Role;

use App\Src\Mappers\Request\Role\RoleRequestUpdateMapper;
use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'title' => 'string',
            'code_in_nmbrs' => 'int'
        ];
    }

    public function map()
    {
        return RoleRequestUpdateMapper::toModel($this);
    }
}
