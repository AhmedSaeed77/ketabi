<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'display_name_ar' => 'required|max:255',
            'display_name_en' => 'required|max:255',
            'permissions' => 'nullable',
            'permissions.*'=>['required',Rule::exists('permissions','id')]
        ];
    }
}
