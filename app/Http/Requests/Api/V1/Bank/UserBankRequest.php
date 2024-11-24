<?php

namespace App\Http\Requests\Api\V1\Bank;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserBankRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'bank_id' => ['required', Rule::exists('banks', 'id')],
            'bank_account_number' => ['required'],
            'bank_account_iban' => ['required'],
            'bank_account_name' => ['required'],
        ];
    }
}
