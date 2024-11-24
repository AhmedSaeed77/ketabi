<?php

namespace App\Http\Requests\Api\V1\Payment;

use App\Http\Services\Api\V1\Payment\Helpers\Payable;
use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    use Payable;
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
            'method' => ['required', Rule::in(array_keys($this->methods))],
//            'name' => ['required'],
//            'email' => ['required', 'email:rfc,dns'],
//            'phone' => ['required', new Phone],
            ...$this->methods[$this->input('method')]['validation'],
        ];
    }
}
