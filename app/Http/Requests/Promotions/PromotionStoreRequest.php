<?php

namespace App\Http\Requests\Promotions;

use Illuminate\Foundation\Http\FormRequest;

class PromotionStoreRequest extends FormRequest
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
            'value' => 'required|numeric',
            'point_equivalent' =>'required|numeric',
            'filter_by' => 'required',
            'date' =>'required|date',
            'end_date' => $this->filter_by == 'Date Range' ? 'required|date' : '',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => $this->filter_by == 'Date Range' ? 'The start date field is required' : 'The date field is required',
        ];
    }
}
