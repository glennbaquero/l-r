<?php

namespace App\Http\Requests\Prices;

use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'departure_id' => 'required',
            'arrival_id' => 'required',
            'currency_id' => 'required',
            'price_per_mile' => 'required|numeric',
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
            'currency_id.required' => 'The currency field is required.',
        ];
    }
}
