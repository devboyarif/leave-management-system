<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanCreateRequest extends FormRequest
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
            'name' => 'required|unique:plans,name',
            'type' => 'required',
            'price' => 'required|numeric',
            'interval' => 'required',
            'custom_interval_days' => 'required_if:interval,custom_days',
            'status' => 'required',

            'is_limited_employee' => 'required',
            'max_employees' => 'required_if:is_limited_employee,1|numeric',
            'max_teams' => 'required|numeric',
            'max_leave_types' => 'required|numeric',
            'custom_theme_look' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'custom_interval_days.required_if' => 'The custom days field is required',
            'max_employees.required_if' => 'The max employees field is required',
        ];
    }
}
