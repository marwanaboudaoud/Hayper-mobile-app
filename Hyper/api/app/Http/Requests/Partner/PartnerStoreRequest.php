<?php

namespace App\Http\Requests\Partner;

use App\Src\Mappers\Request\Partner\PartnerRequestSearchMapper;
use App\Src\Mappers\Request\Partner\PartnerRequestStoreMapper;
use Illuminate\Foundation\Http\FormRequest;

class PartnerStoreRequest extends FormRequest
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
            'name' => 'string',
            'address' => 'string',
            'house_number' => 'string',
            'postcode' => 'string',
            'city' => 'string',
            'phone' => 'string',
        ];
    }

    public function map()
    {
        return PartnerRequestStoreMapper::toPartnerModel($this);
    }
}
