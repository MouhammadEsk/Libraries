<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use App\Models\Library;


class StoreLibraryRequest extends FormRequest
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
            'name'=>['required','string'],
            'city'=>['required','string'],
            'street'=>['required','string'],
            'phone'=>['required','string'],
            'email' =>'required|string|unique:users,email',
            'user_id'=>['integer','required','exists:users,id'],




        ];
    }
}
