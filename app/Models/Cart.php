<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = [
        'items_count',
        'total_amount',
    ];
    protected $with = [
        'items',
    ];

    public function items() {
        return $this->hasMany(CartItem::class)->withTrashed();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function itemsCount() : Attribute {
        return Attribute::get(function () {
            return $this->items?->count();
        });
    }

    public function totalAmount() : Attribute {
        return Attribute::get(function () {
            return $this->items?->sum('amount');
        });
    }
}
