<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectUser extends Model
{
    use HasFactory;

    protected $table = 'subject_user';
    protected $guarded = [];
}
