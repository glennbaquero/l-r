<?php

namespace App\Http\Requests\Currencies;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
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
            'name' => 'required|',
            'equivalent_in_dollars_principle_tills' => 'required|numeric',
            'equivalent_in_dollars_additional_tills' => 'required|numeric',
            'symbol' =>  'required',
            'country' => 'required',
        ];
    }
}
