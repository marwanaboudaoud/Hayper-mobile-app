<?php

namespace App\Http\Requests\Role;

use App\Src\Mappers\Request\Role\RoleRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
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
            'title' => 'string|required',
            'code_in_nmbrs' => 'int|required'
        ];
    }

    /**
     * @return \App\Src\Models\Hyper\Role\RoleModel
     */
    public function map()
    {
        return RoleRequestStoreMapper::toModel($this);
    }
}
