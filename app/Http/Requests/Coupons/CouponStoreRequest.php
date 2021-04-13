<?php

namespace App\Http\Requests\Coupons;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
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
            'coupon_type' => 'required',
            'promotion_name' => 'required',
            'promotion_alias' => 'required',
            'trip_type' => 'required',
            'base_fare' => 'required',
            'authorized_by' => 'required',
            'number_of_coupons' => 'required|numeric',
            'coupon_used' => 'numeric',
            'coupon_available' => 'required|numeric',

            'filter_by_date' => 'required',

            'trip_filter' => $this->filter_by_date == 'Travel' || $this->filter_by_date == 'Both' ? 'required' : '',
            'trip_date' => $this->filter_by_date == 'Travel' || $this->filter_by_date == 'Both' ? 'required|date' : '',
            'trip_end_date' => $this->trip_filter == 'Date Range' ? 'required|date' : '',
            'trip_filter_day' => $this->trip_filter == 'Date Range' ? 'required' : '',
            'trip_days' => $this->date_trip_filter_day == 'Personalized' ? 'required' : '',
            
            'purchase_date_filter' => $this->filter_by_date == 'Purchase' || $this->filter_by_date == 'Both' ? 'required' : '',
            'purchase_date' => $this->filter_by_date == 'Purchase' || $this->filter_by_date == 'Both' ? 'required|date' : '',
            'purchase_end_date' => $this->purchase_date_filter == 'Date Range' ? 'required|date' : '',
            'purchase_date_filter_day' => $this->purchase_date_filter == 'Date Range' ? 'required' : '',
            'purchase_date_days' => $this->purchase_date_filter_day == 'Personalized' ? 'required' : '',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => $this->filter_by == 'Date Range' ? 'The start date field is required' : 'The date field is required',
        ];
    }
}
