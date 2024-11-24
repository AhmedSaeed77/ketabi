<?php

namespace App\Http\Requests\Api\V1\Learnable;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LearnableRequest extends FormRequest
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
//        dd($this->input('type'));
        $rules = [
            'public_package' => [
                'type' => ['required', Rule::in(['public_package'])],
                'subject_id' => ['required', Rule::exists('subjects', 'id')->where('is_active', true)],
                'educational_stage_id' => ['required', Rule::exists('educational_stages', 'id')->where('is_active', true)],
                'price' => ['required', 'numeric'],
                'name_ar' => ['required', 'string'],
                'name_en' => ['required', 'string'],
                'description_ar' => ['required', 'string'],
                'description_en' => ['required', 'string'],
                'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                'introduction_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
                'introduction_url' => ['nullable'],
                'duration_in_hours' => ['required', 'integer', 'gte:1'],
                'duration_in_days' => ['required', 'integer', 'gte:1'],
                'subscription_days' => ['required', 'integer', 'gte:1'],
                'is_active' => ['required', 'boolean'],
            ],
            'private_package' => [
                'type' => ['required', Rule::in(['private_package'])],
                'students' => [Rule::requiredIf($this->input('type') == 'private_package'), 'exclude', 'array'],
                'students.*' => [Rule::exists('users', 'id')->where('type', 'student')->where('is_active', true)],
                'subject_id' => ['required', Rule::exists('subjects', 'id')->where('is_active', true)],
                'educational_stage_id' => ['required', Rule::exists('educational_stages', 'id')->where('is_active', true)],
                'price' => ['required', 'numeric'],
                'name_ar' => ['required', 'string'],
                'name_en' => ['required', 'string'],
                'description_ar' => ['required', 'string'],
                'description_en' => ['required', 'string'],
                'image' => ['nullable', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                'introduction_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
                'introduction_url' => ['nullable'],
                'duration_in_hours' => ['required', 'integer', 'gte:1'],
                'duration_in_days' => ['required', 'integer', 'gte:1'],
                'subscription_days' => ['required', 'integer', 'gte:1'],
                'is_active' => ['required', 'boolean'],
            ],
            'category' => [
                'type' => ['required', Rule::in(['category'])],
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'parent_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['private_package', 'public_package'])],
            ],
            'recorded_lecture' => [
                'type' => ['required', Rule::in(['recorded_lecture', 'live_lecture'])],
                'parent_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['category', 'public_package', 'private_package'])],
                'name_ar' => ['nullable'],
                'name_en' => ['nullable'],
                'sort' => ['required', 'integer', 'gte:1'],
                'duration_in_hours' => ['nullable', 'integer'],
                'from' => ['required', 'date'],
                'to' => ['required', 'date'],
                'source_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
                'source_url' => ['nullable'],
                'is_active' => ['required', 'boolean'],
            ],
            'live_lecture' => [
                'type' => ['required', Rule::in(['recorded_lecture', 'live_lecture'])],
                'parent_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['category', 'public_package', 'private_package'])],
                'name_ar' => ['nullable'],
                'name_en' => ['nullable'],
                'sort' => ['required', 'integer', 'gte:1'],
                'duration_in_hours' => ['nullable', 'integer'],
                'source_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
                'from' => ['required', 'date'],
                'to' => ['required', 'date'],
                'source_url' => ['nullable'],
                'is_active' => ['required', 'boolean'],
            ],
            'attachment' => [
                'type' => ['required', Rule::in(['attachment'])],
                'name_ar' => ['required'],
                'name_en' => ['required'],
                'parent_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['private_package', 'public_package'])],
                'price' => ['required', 'numeric', 'gte:1'],
                'sort' => ['required', 'integer', 'gte:1'],
                'image' => ['nullable'],
                'source_url' => ['nullable'],
                'is_individually_sellable' => ['required', 'boolean'],
                'is_active' => ['required', 'boolean'],
            ],
            'attachment_lecture'=>[
                'type' => ['required', Rule::in(['attachment_lecture'])],
                'parent_id' => ['required', Rule::exists('learnables', 'id')->where('user_id', auth('api')->id())->whereIn('type', ['public_package', 'private_package'])],
                'name_ar' => ['nullable'],
                'name_en' => ['nullable'],
                'sort' => ['nullable','integer', 'gte:1'],
                'duration_in_hours' => ['nullable', 'integer'],
                'from' => ['nullable', 'date'],
                'to' => ['nullable', 'date'],
                'price' => ['required', 'numeric', 'gte:1'],
                'source_platform' => ['nullable', Rule::in(['youtube', 'vimeo', 'swarmify', 'zoom'])],
                'source_url' => ['nullable'],
                'is_individually_sellable' => ['required', 'boolean'],
                'is_active' => ['required', 'boolean'],
                ],
        ];

        //        if ($this->method() == 'POST') {
//            $rules['type'] = ['required', 'string', Rule::in(['category', 'recorded_lecture', 'live_lecture', 'attachment'])];
//        }

        return $rules[$this->input('type')];
    }
}
