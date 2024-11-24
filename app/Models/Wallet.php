<?php

namespace App\Models;

use App\Repository\InfoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function totalAmount(): Attribute
    {
        return Attribute::get(function () {
            return number_format(abs($this->deposits?->sum('amount') + $this->refunds?->sum('amount') - $this->withdrawals?->sum('amount')), 2,'.','');
        });
    }

    protected function withdrawableAmount(): Attribute
    {
        return Attribute::get(function () {
            return number_format(abs((float)$this->total_amount - (float)$this->unwithdrawableDeposits?->sum('amount')), 2,'.','');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'wallet_id');
    }

    public function deposits()
    {
        return $this->transactions()->where('type', 'deposit');
    }

    public function unwithdrawableDeposits()
    {
        $infoRepository = app(InfoRepositoryInterface::class);
        return $this->deposits()->where('created_at', '>=', Carbon::now()->subDays((int)$infoRepository->getValue('withdrawal_after')));
    }

    public function withdrawals()
    {
        return $this->transactions()->whereIn('type', ['withdrawal', 'pending_withdrawal']);
    }

    public function refunds()
    {
        return $this->transactions()->where('type', 'refund');
    }

}
