<?php

namespace App\Http\Requests\Dashboard\RateQuestion;

use Illuminate\Foundation\Http\FormRequest;

class RateQuestionRequest extends FormRequest
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
            'question_ar' => 'required|string',
            'question_en' => 'required|string',
            'type' => 'required|in:platform,teacher',
        ];
    }
}
