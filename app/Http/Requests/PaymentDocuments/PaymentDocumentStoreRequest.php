<?php

namespace App\Http\Requests\PaymentDocuments;

use Illuminate\Foundation\Http\FormRequest;

class PaymentDocumentStoreRequest extends FormRequest
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
            'user_id' => 'required',
            'document_number' => 'required',
            'payment_document' => 'required',
            'payment_type' => 'required',
            'amount' => 'required|numeric',
            'number_of_voucher' => 'required|numeric',
        ];
    }

    public function messages() 
    {
        return [
            'user_id.required' => 'The agent field is required.'
        ];
    }
}
