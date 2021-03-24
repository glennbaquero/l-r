<?php

namespace App\Http\Requests\Baggages;

use Illuminate\Foundation\Http\FormRequest;

class BaggageStoreRequest extends FormRequest
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
            'ticket_id' => 'required',
            'alias' => 'required',
            'total_weight' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'payment_form' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'ticket_id.required' => 'The ticket field is required.'
        ];
    }
}
