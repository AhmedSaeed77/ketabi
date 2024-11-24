<?php

namespace App\Http\Requests\Api\V1\Learnable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LearnableStepOneRequest extends FormRequest
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
            'type' => ['required', Rule::in(['public_package', 'private_package'])],
            'subject_id' => ['required', Rule::exists('subjects', 'id')->where('is_active', true)],
            'educational_stage_id' => ['required', Rule::exists('educational_stages', 'id')->where('is_active', true)],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'description_ar' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'introduction_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
            'introduction_url' => ['nullable'],
            'is_active' => ['required', 'boolean'],
            'students' => [Rule::requiredIf($this->input('type') == 'private_package'), 'exclude', 'array'],
            'students.*' => [Rule::exists('users', 'id')->where('type', 'student')->where('is_active', true)],
        ];
    }
}
