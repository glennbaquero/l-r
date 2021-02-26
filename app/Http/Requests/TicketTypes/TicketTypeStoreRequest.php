<?php

namespace App\Http\Requests\TicketTypes;

use Illuminate\Foundation\Http\FormRequest;

class TicketTypeStoreRequest extends FormRequest
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
        $for_updating = $this->id;

        return [
            'name' => 'required',
            'document_type_id' => 'required',
            'discount' => 'required|numeric',
            'selectedIds' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'document_type_id.required' => 'Document type field is required',
            'selectedIds.required' => 'Dependence field is required',
        ];
    }
}
