<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\LanguageToggle;

class ContactUs extends Model
{
    use HasFactory, LanguageToggle;

    protected $table = 'contact_us';
    protected $guarded = [];
}
