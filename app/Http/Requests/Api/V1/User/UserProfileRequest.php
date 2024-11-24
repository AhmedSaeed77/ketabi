<?php

namespace App\Http\Requests\Api\V1\User;

use App\Http\Traits\Authenticatable;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserProfileRequest extends FormRequest
{
    use Authenticatable;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique('users', 'email')->ignore(auth('api')->id(), 'id')
            ],
            'phone' => [
                'required',
                new Phone,
                Rule::unique('users', 'phone')->ignore(auth('api')->id(), 'id'),
            ],
            'show_phone' => ['required', 'in:0,1'],
            'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ...$this->types[auth('api')->user()->type]['registration_rules']
        ];
    }
}
