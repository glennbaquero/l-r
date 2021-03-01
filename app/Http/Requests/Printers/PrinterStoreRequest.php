<?php

namespace App\Http\Requests\Printers;

use Illuminate\Foundation\Http\FormRequest;

class PrinterStoreRequest extends FormRequest
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
            'printer_brand_id' => 'required',
            'printer_model_id' => 'required',
            'name' => 'required',
            'code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'printer_brand_id.required' => 'Printer brand field is required.',
            'printer_model_id.required' => 'Printer model field is required.'
        ];
    }
}
