<?php

namespace App\Http\Requests\Partner;

use App\Src\Mappers\Request\Partner\PartnerRequestUpdateMapper;
use Illuminate\Foundation\Http\FormRequest;

class PartnerUpdateRequest extends FormRequest
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
            'address' => 'required|string',
            'house_number' => 'required|string',
            'postcode' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
        ];
    }

    public function map()
    {
        return PartnerRequestUpdateMapper::toPartnerModel($this);
    }
}
