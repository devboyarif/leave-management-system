<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateequest extends FormRequest
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
            'password' => 'sometimes|string|min:6|confirmed',
            'team_id' => 'required|integer',
        ];
    }

    public function message()
    {
        return [
            'team_id' => 'The team field is required.',
        ];
    }
}
