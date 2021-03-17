<?php

namespace App\Http\Requests\Buses;

use Illuminate\Foundation\Http\FormRequest;

class BusStoreRequest extends FormRequest
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
            'name' => 'required',
            'plate' => 'required',
            'bus_model_id' => 'required',
            'transport_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'bus_model_id.required' => 'The bus model field is required.'
        ];
    }

}
