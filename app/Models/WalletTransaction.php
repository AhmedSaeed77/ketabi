<?php

namespace App\Models;

use App\Repository\InfoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $guarded = [];

    protected function isWithdrawable() : Attribute {
        return Attribute::get(function () {
            $infoRepository=app(InfoRepositoryInterface::class);
            return $this->type == 'deposit' ? Carbon::parse($this->created_at)->diffInDays(Carbon::now(), false) >= (int) $infoRepository->getValue('withdrawal_after') : null;
        });
    }

    public function wallet() {
        return $this->belongsTo(Wallet::class);
    }

    public function typeValue() : Attribute {
        return Attribute::get(function (){
            return __('db.wallet.'.$this->type);
        });
    }
}
