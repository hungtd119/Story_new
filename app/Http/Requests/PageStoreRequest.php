<?php

namespace App\Http\Requests;

use App\Exceptions\ErrorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PageStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image_id'=>'required',
            'page_number'=>'required',
            'story_id'=>'required',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw ErrorException::validation('Validation errors', $validator->errors());
    }
    public function messages()
    {
        return [
            'image_id.required' => 'Imager is required',
            'page_number.required' => 'Page Number is required',
            'story_id.required' => 'Story is required',
        ];
    }
}
