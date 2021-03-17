<?php

namespace App\Http\Requests\Buses;

use Illuminate\Foundation\Http\FormRequest;

class BusModelStoreRequest extends FormRequest
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
            'rows' => 'required|numeric|min:1',
            'columns' => 'required|numeric|min:1',
            'seats' => 'required|numeric',
            'floors' => 'required|numeric',
        ];
    }

}
