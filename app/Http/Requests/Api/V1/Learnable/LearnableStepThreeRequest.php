<?php

namespace App\Http\Requests\Api\V1\Learnable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LearnableStepThreeRequest extends FormRequest
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
            'package_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['private_package', 'public_package'])],
            'lecture_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['recorded_lecture', 'live_lecture'])],
            'parent_id' => ['nullable', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['category', 'private_package', 'public_package'])],
            'type' => ['required', Rule::in(['recorded_lecture', 'live_lecture'])],
            'sort' => ['required', 'integer'],
            'name_ar' => ['nullable', 'string'],
            'name_en' => ['nullable', 'string'],
            'duration_in_hours' => ['nullable', 'integer'],
            'from' => ['required'],
            'to' => ['required'],
            'source_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
            'source_url' => ['nullable'],
            'is_active' => ['required', 'boolean']
        ];
    }
}
