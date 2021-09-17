<?php

namespace App\Http\Requests\Payments;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizeNetPaymentStoreRequest extends FormRequest
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
            'cc_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cc_number.required' => 'The card number field is required.',
            'expiry_month.required' => 'The expiration month field is required.',
            'expiry_year.required' => 'The expiration year field is required.',
            'cvv.required' => 'The cvv field is required.',
        ];
    }
}
