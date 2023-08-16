<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AudioStoreRequest extends FormRequest
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
            'filename'=>'required',
            'path'=>'required',
            'time'=>'required',
            'text_id'=>'required'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'message'=> 'Validation errors',
            'data'   => $validator->errors()
        ],404));
    }
    public function messages()
    {
        return [
            'filename.required' => 'Filename is required',
            'path.required' => 'Path is required',
            'time.required' => 'Time is required',
            'text_id.required' => 'Text is required'
        ];
    }
}
