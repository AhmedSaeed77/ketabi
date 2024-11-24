<?php

namespace App\Http\Requests\Api\V1\Cart;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddCartItemRequest extends FormRequest
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
            'learnable_id' => [
                'required',
                Rule::exists('learnables', 'id')
                    ->whereIn('type', ['private_package', 'public_package', 'attachment','attachment_lecture'])
                    ->where('is_active', true),
            ],
        ];
    }
}
