<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    use LanguageToggle;

    public $guarded = [];

    public function managersCount(): Attribute
    {
        return Attribute::make(get: function () {
            return $this->managers()->count();
        });
    }
}
