<?php

namespace App\Http\Traits;

use Illuminate\Validation\Rule;

trait Authenticatable
{
    private array $types = [
        'student' => [
            'name' => 'student',
            'registration_rules' => [
                'educational_stage_id' => ['required', 'exists:educational_stages,id,is_active,1'],
            ]
        ],
        'teacher' => [
            'name' => 'teacher',
            'registration_rules' => [
                'educational_stage_id' => ['required', 'array'],
                'educational_stage_id.*' => 'exists:educational_stages,id,is_active,1',
                'subject_id' => ['required', 'array'],
                'subject_id.*' => 'exists:subjects,id,is_active,1',
                'cv' => ['nullable','exclude','image','mimes:pdf,doc,docx','max:5120'],
                'bio' => ['nullable', 'string'],
            ]
        ],
    ];
}
