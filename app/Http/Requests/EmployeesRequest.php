<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'department_id' => 'required',
            'city_id' => 'required',
            'zipcode' => 'required',
            'birthdate' => 'required',
            'date_hired' => 'required',
        ];
    }
}
