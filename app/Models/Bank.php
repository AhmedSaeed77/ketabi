<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function users() {
        return $this->hasMany(User::class);
    }
}
