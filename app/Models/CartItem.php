<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $appends = [
        'amount',
    ];

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function learnable(){
        return $this->belongsTo(Learnable::class);
    }

    public function amount() : Attribute {
        return Attribute::get(function () {
            return $this->learnable->price;
        });
    }
}
