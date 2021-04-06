<?php

namespace App\Http\Requests\DiscountOptions;

use Illuminate\Foundation\Http\FormRequest;

class DiscountOptionStoreRequest extends FormRequest
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
            'option_name' => 'required',
            'option_type' => 'required',
        ];
    }
}
