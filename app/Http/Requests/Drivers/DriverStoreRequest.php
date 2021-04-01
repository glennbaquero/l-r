<?php

namespace App\Http\Requests\Drivers;

use Illuminate\Foundation\Http\FormRequest;

class DriverStoreRequest extends FormRequest
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
            // 'document_type' => 'required',
            'document_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            // 'address' => 'required',
            'city' => 'required',
            'license_type' => 'required',
            'license_no' => 'required',
            'license_expiration_date' => 'required|date',
            'last_medical_test_date' => 'required|date',
            'next_medical_test_date' => 'required|date',
        ];
    }


    public function messages()
    {
        return [
            'document_no.required' => 'The commercial driver license field is required.'
        ];
    }
}
