<?php

namespace App\Http\Requests\Terminals;

use Illuminate\Foundation\Http\FormRequest;

class TerminalStoreRequest extends FormRequest
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
            'office_id' => 'required',
            'operating_system' => 'required',
            'web_browser' =>  'required',
            'printer_id' => 'required',
            'printer_brand_id' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'office_id.required' => 'Office field is required.',
            'printer_id.required' => 'Printer field is required.',
            'printer_brand_id.required' => 'Printer brand field is required.'
        ];
    }
}
