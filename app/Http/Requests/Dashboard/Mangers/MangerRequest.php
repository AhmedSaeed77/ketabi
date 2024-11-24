<?php

namespace App\Http\Requests\Dashboard\Mangers;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class MangerRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email:rfc,dns',
                $this->method() == 'POST'
                    ? Rule::unique('users', 'email')
                    : Rule::unique('users', 'email')->ignore($this->id, 'id')
            ],
            'phone' => [
                'required',
                new Phone,
                $this->method() == 'POST'
                    ? Rule::unique('users', 'phone')
                    : Rule::unique('users', 'phone')->ignore($this->id, 'id'),
            ],
            'password' => $this->method() == 'POST'?Password::min(8)->required():'nullable',
            'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'is_active'=>'in:on,',

        ];
    }
}
