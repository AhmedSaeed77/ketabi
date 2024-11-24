<?php

namespace App\Http\Requests\Dashboard\Manager;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:managers,email' . ($this->isMethod('PUT') ? ',' . $this->manager : ''),
            'phone' => ['required', new Phone,'unique:managers,phone' . ($this->isMethod('PUT') ? ',' . $this->manager : '')],
            'password' => ($this->isMethod('POST') ? 'required|' : 'nullable|') . 'min:8|confirmed',
            'image' => 'nullable|exclude|image|mimes:jpg,jpeg,png|max:2048',
            'experience_id' => ['sometimes', 'required', Rule::exists('experiences', 'id')->where('is_active', true)],
            'cv' => 'sometimes|required|exclude|file|mimes:pdf,doc,docx|max:5120',
            'bio' => 'sometimes|required|string',
            'introduction_video_platform' => 'required_with:introduction_video_link|nullable|in:youtube,vimeo,swarmify,zoom',
            'introduction_video_link' => 'required_with:introduction_video_platform|nullable',
            'is_active' => 'nullable',
            'is_best_teacher' => 'nullable',
            'is_approved' => 'nullable',
        ];
    }
}
