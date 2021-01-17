<?php

namespace App\Http\Requests\Upload;

use App\Src\Mappers\Request\Upload\DocumentRequestUploadMapper;
use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'body' => 'file|required',
            'document_type' => 'string|required',
            'user_id' => 'int|required'
        ];
    }

    public function map()
    {
        return DocumentRequestUploadMapper::toDocumentModel($this);
    }
}
