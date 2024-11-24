<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required:max:255' ,
            'email' => ['required' , Rule::unique('users' , 'email')->ignore(auth('api')->user()->id)],
            'phone' => ['required' , Rule::unique('users' , 'phone')->ignore(auth('api')->user()->id)],
        ];
    }
}
