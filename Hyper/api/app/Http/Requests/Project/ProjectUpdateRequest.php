<?php


namespace App\Http\Requests\Project;

use App\Src\Mappers\Request\Project\ProjectRequestUpdateMapper;
use App\Src\Models\Hyper\Project\ProjectModel;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
{
    /**
     * Determine if the use is authorized to make request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'is_active' => 'required|bool',
            'partner_id' => 'required|int',
            'commission_rates' => 'array',
            'commission_rates.*.rate' => 'required|numeric',
            'commission_rates.*.amount' => 'required|numeric',
        ];
    }

    /**
     * @param $id
     * @return ProjectModel
     */
    public function map($id)
    {
        $this->request->add(['id' => $id]);

        return ProjectRequestUpdateMapper::toModel($this);
    }
}
