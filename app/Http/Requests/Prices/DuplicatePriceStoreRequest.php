<?php

namespace App\Http\Requests\Prices;

use Illuminate\Foundation\Http\FormRequest;

class DuplicatePriceStoreRequest extends FormRequest
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
            'arrival_id' => 'required',
            'departure_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'departure_id.required' => 'The departure field is required.',
            'arrival_id.required' => 'The arrival field is required.',
        ];
    }
}
