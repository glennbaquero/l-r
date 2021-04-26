<?php

namespace App\Http\Requests\Discounts;

use Illuminate\Foundation\Http\FormRequest;

class DiscountStoreRequest extends FormRequest
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
            'promotion_apply_to' => 'required',
            'change_type' => 'required',
            'option' => 'required',
            'max_per_bus_value' => 'required|numeric',
            'filter_by' => 'required',
            'date' =>'required|date',
            'end_date' => $this->filter_by == 'Date Range' ? 'required|date' : '',
            'days' => $this->filter_day == 'Personalized' ? 'required' : '',
            'trip_type' => 'required',
            'service_ids' => 'required',
            'ticket_type_ids' => 'required',

            'partnership' => $this->promotion_apply_to != 'System' ? 'required' : '',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => $this->filter_by == 'Date Range' ? 'The start date field is required' : 'The date field is required',
            'days.required' =>'The days field is required, please select one item.',
            'service_ids.required' =>'The service field is required, please select one item.',
            'ticket_type_ids.required' =>'The ticket type field is required, please select one item.',
        ];
    }
}
