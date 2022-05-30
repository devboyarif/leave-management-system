<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$this->employee->id}",
            'user_id' => 'required|integer',
            'team_id' => 'required|integer',
        ];
    }

    public function message()
    {
        return [
            'user_id' => 'The company field is required.',
            'team_id' => 'The team field is required.',
        ];
    }
}
