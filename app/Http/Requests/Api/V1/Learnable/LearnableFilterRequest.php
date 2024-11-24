<?php

namespace App\Http\Requests\Api\V1\Learnable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LearnableFilterRequest extends FormRequest
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
            'educational_stage_id' => ['nullable', Rule::exists('educational_stages', 'id')->where('is_active', true)],
            'subject_id' => ['nullable', Rule::exists('subjects', 'id')->where('is_active', true)],
        ];
    }
}
