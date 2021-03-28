<?php

namespace App\Http\Requests\Routes;

use Illuminate\Foundation\Http\FormRequest;

class RouteStoreRequest extends FormRequest
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
            'name' => 'required',
            'alias' => 'required',
            'report_alias' => 'required',
            'departure_id' => 'required',
            'type_of_route' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'departure_id.required' => 'Departure field is required.',
        ];
    }
}
