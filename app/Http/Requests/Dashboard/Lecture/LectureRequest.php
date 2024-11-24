<?php

namespace App\Http\Requests\Dashboard\Lecture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LectureRequest extends FormRequest
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'platform' => 'required|in:youtube,vimeo,swarmify,zoom',
            'link' => 'required',
            'minutes' => 'required',
            'show_in_package' => 'nullable',
            'show_in_profile' => $request->show_in_package ? 'nullable' :'required' ,
            'package_id' => 'sometimes|required_if:show_in_package,on|exists:packages,id',
            'sort_in_package' => 'sometimes|required_if:show_in_package,on|numeric',
            'image' => $request->method() == 'POST' ? 'required|mimes:jpeg,png,jpg,gif,svg' : 'nullable|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
}
