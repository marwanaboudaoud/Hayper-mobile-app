<?php

namespace App\Http\Requests\Auth;

use App\Src\Mappers\Request\Auth\ResetPasswordRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|confirmed',
            'token' => 'required'
        ];
    }

    public function map()
    {
        return ResetPasswordRequestMapper::toModel($this);
    }
}
