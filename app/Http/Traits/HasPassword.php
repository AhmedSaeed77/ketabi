<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPassword
{
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }
}
