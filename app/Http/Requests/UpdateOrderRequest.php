<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'number'=>['required','string'],
            'status'=>['required','string'],
            'date'=>['date','required'],
            'user_id'=>['integer','required','exists:users,id'],
            'book_id'=>['integer','required','exists:books,id'],
        ];
    }
}
