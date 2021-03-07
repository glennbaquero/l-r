<?php

namespace App\Http\Requests\Recommendations;

use Illuminate\Foundation\Http\FormRequest;

class RecommendationStoreRequest extends FormRequest
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
        $regex = '/^https:\/\/www.youtube.com\/embed\//';
        return [
            'name' => 'required',
            'source' => 'required|regex:'.$regex
        ];
    }

    public function messages() 
    {
        return [
            'source.regex' => 'The source format is invalid. Correct format : https://www.youtube.com/embed/0dTyTy3d7us'
        ];
    }
}
