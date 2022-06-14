<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequestSaveRequest extends FormRequest
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
            'leave_type_id' => 'required|exists:leave_types,id',
            'employee_id' => 'required|exists:employees,id',
            'start' => 'required|date',
            'end' => 'required|date',
            'reason' => 'required',
            'status' => 'required',
        ];
    }

    public function message()
    {
        return [
            'leave_type_id' => 'The leave type field is required.',
            'employee_id' => 'The employee field is required.',
            'start' => 'The start date field is required.',
            'end' => 'The end date field is required.',
        ];
    }
}
