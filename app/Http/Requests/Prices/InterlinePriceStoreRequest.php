<?php

namespace App\Http\Requests\Prices;

use Illuminate\Foundation\Http\FormRequest;

class InterlinePriceStoreRequest extends FormRequest
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
            'company_id' => 'required',
            'departure_id' => 'required',
            'arrival_id' => 'required',
            'arrival_price' => 'required|numeric',
            'departure_price' => 'required|numeric',
            'round_trip_price' => 'required|numeric',
            'minimum_price' => 'required|numeric',
            'maximum_price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'departure_id.required' => 'The departure field is required.',
            'arrival_id.required' => 'The arrival field is required.',
            'company_id.required' => 'The company field is required.',
        ];
    }
}
