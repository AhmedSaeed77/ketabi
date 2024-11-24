<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PackageRequest extends FormRequest
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
            'image' => $request->method() == 'POST' ? 'required|mimes:jpeg,png,jpg,gif,svg' : 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'package_category_id' => 'required|exists:package_categories,id',
            'educational_stage_id' => 'required|exists:educational_stages,id',
            'subject_id' => 'required|exists:subjects,id',
            'start_at' => 'required|date',
            'default_seats' => 'required|numeric',
            'hours' => 'required|string',
            'price' => 'required|numeric',
            'duration_days' => 'required|string',
        ];
    }
}
