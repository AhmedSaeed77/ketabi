<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    // todo: this will be from dashboard
    public const WITHDRAWABLE_AFTER = 30;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function learnable() {
        return $this->belongsTo(Learnable::class);
    }


}
