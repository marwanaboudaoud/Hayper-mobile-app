<?php

namespace App\Http\Requests\Availability;

use App\Src\Mappers\Request\Availability\AvailabilityStoreRequestMapper;
use App\Src\Mappers\Request\Availability\AvailabilityUpdateRequestMapper;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use Illuminate\Foundation\Http\FormRequest;

class AvailabilityUpdateRequest extends FormRequest
{
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
            'date' => 'required|date_format:"Y-m-d"',
            'is_present' => 'required|boolean',
            'availability_shift_id' => 'required_if:is_present,1|int'
        ];
    }

    /**
     * @return AvailabilityModel
     */
    public function map()
    {
        return AvailabilityUpdateRequestMapper::toModel($this);
    }
}
