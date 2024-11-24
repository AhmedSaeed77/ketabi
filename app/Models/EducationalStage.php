<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStage extends Model
{
    use HasFactory, LanguageToggle;

    protected $guarded = [];

    public function teahcers() {
        return $this->belongsToMany(User::class)->where('type', 'teacher');
    }

    public function students() {
        return $this->hasMany(User::class)->where('type', 'student');
    }
    public function getNameAttribute(){
        return $this->t('name');
    }
}
