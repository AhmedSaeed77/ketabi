<?php

namespace App\Http\Requests\Api\V1\Contact;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=>'string|required|max:255',
            'email'=>['required','email:rfc,dns'],
            'phone' => [
                'required',
                new Phone,],
            'subject'=>'string|required|max:255',
            'message'=>'string|required'
        ];
    }
}
