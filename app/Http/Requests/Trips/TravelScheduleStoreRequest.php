<?php

namespace App\Http\Requests\Trips;

use Illuminate\Foundation\Http\FormRequest;

class TravelScheduleStoreRequest extends FormRequest
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'transport_type' => 'required',
            // 'bus_id' => 'required',
            // 'driver_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'route_id.required' => 'The route field is required.',
            // 'driver_id.required' => 'The driver field is required.',
            'bus_id.required' => 'The bus field is required.',
        ];
    }
}
