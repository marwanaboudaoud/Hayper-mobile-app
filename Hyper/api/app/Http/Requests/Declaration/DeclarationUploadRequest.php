<?php

namespace App\Http\Requests\Declaration;

use App\Src\Mappers\Request\Declaration\DeclarationUploadRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class DeclarationUploadRequest extends FormRequest
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
            'declaration_type' => 'required|string',
            'date_of_submission' => 'required|date',
            'location' => 'required|string',
            'amount_exc_vat' => 'required|numeric|between:0,99.99',
            'vat' => 'required|int',
            'image' => 'required|file'
        ];
    }

    public function map()
    {
        return DeclarationUploadRequestMapper::toModel($this);
    }
}
