<?php

namespace App\Http\Requests\Vouchers;

use Illuminate\Foundation\Http\FormRequest;

class VoucherStoreRequest extends FormRequest
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
            'passenger_id' => 'required',
            'amount' => $this->type_of_voucher == 'Amount' ? 'required|numeric' : '',
            'max_no_of_ticket_courtesy' => $this->type_of_voucher == 'Max. Courtesy Ticket' ? 'required|numeric' : '',
            'discount_percent' => $this->type_of_voucher == 'Max. Ticket % Discount' ? 'required|numeric' : '',
            'max_no_of_discount_ticket' => $this->type_of_voucher == 'Max. Ticket % Discount' ? 'required|numeric' : '',
            'expiration_date' => 'required|date',
            'authorized_by' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'passenger_id.required' => 'The passenger field is required',
        ];
    }
}
