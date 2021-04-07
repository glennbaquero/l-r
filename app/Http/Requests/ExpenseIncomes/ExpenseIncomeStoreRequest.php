<?php

namespace App\Http\Requests\ExpenseIncomes;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseIncomeStoreRequest extends FormRequest
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
            'type' => 'required',
            'income_expense_type' => 'required',
            'concept' => 'required',
            'amount' => 'required|numeric',
            'authorized_by' => 'required',
        ];
    }
}
