<?php

namespace App\Http\Requests\Auth;

use App\Src\Mappers\Request\Auth\ForgotPasswordRequestMapper;
use App\Src\Models\Hyper\Auth\ForgotPasswordModel;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'email|required',
            'host' => 'required|url'
        ];
    }

    /**
     * @return ForgotPasswordModel
     */
    public function map()
    {
        return ForgotPasswordRequestMapper::toForgotPasswordModel($this);
    }
}
