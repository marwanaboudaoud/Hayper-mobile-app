<?php


namespace App\Http\Requests\Project;

use App\Src\Mappers\Request\Project\ProjectStoreRequestMapper;
use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
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
            'is_active' => 'required|bool',
            'partner_id' => 'required|int',
            'commission_rates' => 'array',
            'commission_rates.*.rate' => 'required|numeric',
            'commission_rates.*.amount' => 'required|numeric',
            'commission_rates.*.role_id' => 'required|int',
        ];
    }

    public function map()
    {
        return ProjectStoreRequestMapper::toModel($this);
    }
}
