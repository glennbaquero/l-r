<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'firstname' => 'required|',
            'lastname' => 'required|',
            'email' =>  $for_updating ? 'email|unique:users,email,'.$this->id : 'email|required|unique:users,email',
            'username' =>  $for_updating ? 'required|unique:users,username,'.$this->id : 'required|required|unique:users,username',
            'office_id' => 'required',
            'group_id' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required',
            'cellphone_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'office_id.required' => 'Office field is required',
            'group_id.required' => 'Group field is required'
        ];
    }
}
