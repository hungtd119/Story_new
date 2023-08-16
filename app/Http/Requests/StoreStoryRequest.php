<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStoryRequest extends FormRequest
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
            'title'=>'required|max:100',
            'image_id'=>'required',
            'author'=>'required',
            'illustrator'=>'required',
            'level'=>'required',
            'coin'=>'required'
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
            'title.required' => 'Title is required',
            'image_id.required' => 'Image is required',
            'author.required' => 'Author is required',
            'illustrator.required' => 'Illustrator is required',
            'level.required' => 'Level is required',
            'coin.required' => 'Coin is required',
        ];
    }
}
