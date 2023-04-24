<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
    {   return [
        'name'=>['required','string'],
        'info'=>['required','string'],
        'auther'=>['required','string'],
        'publishing_house'=>['required','string'],
        'date'=>['required','date'],
        'availablity'=>['required','boolean'],
        'price'=>['required','integer'],
        'link'        =>['file','required'],
        'category_id'=>['integer','required','exists:categories,id']


     ];
    }
}
