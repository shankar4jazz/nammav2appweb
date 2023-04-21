<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobsPlanCategoryRequest extends FormRequest
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
        $id = request()->id;
        return [
            'en_name'              => 'required|unique:jobs_plan_category,en_name,'.$id,
            'status'            => 'required',
        ];
    }
}
