<?php

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Traits\Authenticatable;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'type' => ['required', Rule::in(['teacher', 'student'])],
            'name' => 'required|string',
            'email' => [
                'required',
                'email:rfc,dns',
                $this->method() == 'POST'
                    ? Rule::unique('users', 'email')
                    : Rule::unique('users', 'email')->ignore(auth('api')->id(), 'id')
            ],
            'phone' => [
                'required',
                new Phone,
                $this->method() == 'POST'
                    ? Rule::unique('users', 'phone')
                    : Rule::unique('users', 'phone')->ignore(auth('api')->id(), 'id'),
            ],
            'show_phone' => $this->type == 'teacher' ? ['required', 'in:0,1'] : 'nullable',
            'password' => Password::min(8)->required(),
            'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ...$this->types[$this->input('type')]['registration_rules']
        ];

    }
}
