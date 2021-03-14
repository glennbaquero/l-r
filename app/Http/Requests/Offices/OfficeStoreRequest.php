<?php

namespace App\Http\Requests\Offices;

use Illuminate\Foundation\Http\FormRequest;

class OfficeStoreRequest extends FormRequest
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
        $for_updating = $this->id;

        return [
            'name' => 'required',
            // 'office_no' => 'required',
            'phone_number' => 'required',
            'office_type_id' => 'required',
            'city' => 'required',
            // 'terminal_id' => 'required',
            // 'departure_city_id' => 'required',
            // 'arrival_city_id' => 'required',
            'address_line_1' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'office_type_id.required' => 'Office type field is required',
            'terminal_id.required' => 'Terminal field is required',
            // 'departure_city_id.required' => 'Departure city field is required',
            // 'arrival_city_id.required' => 'Arrival city field is required',
            'address_line_1.required' => 'Address field is required'
        ];
    }
}
