<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class)->withTrashed();
    }

    public function subscriptions (){
        return $this->hasMany(Subscription::class);
    }

    public function statusType(): Attribute
    {
        return Attribute::make(get: function () {
            if ($this->status == 'pending')
                return __('dashboard.pending');
            if ($this->status == 'confirmed')
                return __('dashboard.confirmed');
            elseif ($this->status == 'being_reviewed')
                return __('dashboard.being_reviewed');
            elseif ($this->status == 'failed')
                return __('dashboard.failed');
            elseif ($this->status == 'refused')
                return __('dashboard.refused');
        }
        );

    }
}
