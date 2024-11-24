<?php

namespace App\Http\Requests\Dashboard\Experience;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ExperienceRequest extends FormRequest
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ];
    }
}
