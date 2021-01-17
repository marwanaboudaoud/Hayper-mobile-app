<?php

namespace App\Http\Requests\Friend;

use App\Src\Mappers\Request\Friend\FriendSignUpRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class SignUpAFriendRequest extends FormRequest
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
            'name' => 'required|string',
            'age' => 'required|string',
            'phone' => 'required|string',
            'location' => 'required|string'
        ];
    }

    public function map()
    {
        return FriendSignUpRequestMapper::toModel($this);
    }
}
