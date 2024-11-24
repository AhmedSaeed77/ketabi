<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        return [
            'type' => ['required', Rule::in(['teacher', 'student'])],
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
            'cv' => ['nullable', 'exclude', 'image', 'mimes:application/pdf, application/x-pdf,application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf', 'max:2048'],
            'subjects'=>['nullable'],
            'subjects.*'=>['required','string'],
            'stages'=>['nullable'],
            'stages.*'=>['required','string'],
            'educational_stage_id'=>$this->type=='student'?['required',Rule::exists('educational_stages','id')]:'nullable',
            'is_active'=>'in:on,',
            'bank_id'=>$this->type=='teacher'?['required',Rule::exists('banks','id')]:'nullable',
            'bank_account_number'=>$this->type=='teacher'?['required','numeric']:'nullable',
            'bank_account_name'=>$this->type=='teacher'?['required','string','max:255']:'nullable',
        ];
    }
}
