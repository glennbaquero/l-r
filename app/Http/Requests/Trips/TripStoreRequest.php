<?php

namespace App\Http\Requests\Trips;

use Illuminate\Foundation\Http\FormRequest;

class TripStoreRequest extends FormRequest
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
            'route_id' => 'required',
            'alias_route' => 'required',
            'date' => 'required|date',
            'time_list' => 'required',
            'transport_type' => 'required',
            // 'bus_id' => 'required',
            'driver_list' => 'required',
            'bus_list' => 'required',
            'arrival_time' => 'required',
            'max_baggage' => 'required|numeric',
            'additional_bag_fee' => 'required|numeric',
            // 'main_co_driver_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'route_id.required' => 'The route field is required.',
            // 'driver_id.required' => 'The driver field is required.',
            // 'bus_id.required' => 'The bus field is required.',
            'time_list.required' => 'The time field is required. Please add atleast one.',
            'driver_list.required' => 'The driver field is required.',
            'bus_list.required' => 'The bus field is required.',
            'arrival_time.required' => 'The arrival time field is required.',
            // 'main_co_driver_id.required' => 'The main co driver field is required.',
        ];
    }
}
