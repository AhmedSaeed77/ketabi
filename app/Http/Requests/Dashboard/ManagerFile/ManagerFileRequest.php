<?php

namespace App\Http\Requests\Dashboard\ManagerFile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ManagerFileRequest extends FormRequest
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
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'pages_count' => 'required|numeric',
            'price' => 'nullable|numeric',
            'show_in_package' => 'nullable',
            'show_in_profile' => $request->show_in_package ? 'nullable' :'required' ,
            'package_id' => 'sometimes|required_if:show_in_package,on|exists:packages,id',
            'sort_in_package' => 'sometimes|required_if:show_in_package,on|numeric',
            'file' => $request->method() == 'POST' ? 'required|mimes:pdf' : 'nullable|mimes:pdf',
        ];
    }
}
