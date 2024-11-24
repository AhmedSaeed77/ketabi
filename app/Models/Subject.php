<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, LanguageToggle;

    protected $guarded = [];

    protected function imageUrl() : Attribute {
        return Attribute::get(fn () => $this->image !== null ? url($this->image) : null);
    }

    public function users() {
        return $this->belongsToMany(User::class)->where('type', 'student');
    }
    public function getNameAttribute(){
        return $this->t('name');
    }
}
