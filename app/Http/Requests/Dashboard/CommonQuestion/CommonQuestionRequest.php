<?php

namespace App\Http\Requests\Dashboard\CommonQuestion;

use Illuminate\Foundation\Http\FormRequest;

class CommonQuestionRequest extends FormRequest
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
            'question_ar' => 'required|string' ,
            'question_en' => 'required|string' ,
            'answer_ar' => 'required|string' ,
            'answer_en' => 'required|string' ,
        ];
    }
}
