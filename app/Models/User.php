<?php

namespace App\Models;

use App\Http\Traits\HasPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasPassword, HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    protected function isStudent() : Attribute {
        return Attribute::get(fn () => $this->type == 'student');
    }

    protected function imageUrl() : Attribute {
        return Attribute::get(fn () => $this->image !== null ? url($this->image) : null);
    }

    protected function cvUrl() : Attribute {
        return Attribute::get(fn () => $this->cv !== null ? url($this->cv) : null);
    }

    protected function cartItemsCount() : Attribute {
        return Attribute::get(function () {
            return $this->cartItems?->count();
        });
    }

    public function scopeIsTeacher(Builder $query) {
        $query->where('type', 'teacher');
    }

    public function scopeIsStudent(Builder $query) {
        $query->where('type', 'student');
    }

    public function educationalStages()
    {
        return $this->belongsToMany(EducationalStage::class);
    }
    public function studentStage()
    {
        return $this->belongsTo(EducationalStage::class,'educational_stage_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function learnables() {
        return $this->belongsToMany(Learnable::class);
    }

    public function learnablesAsTeacher() {
        return $this->hasMany(Learnable::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }

    public function cartItems() {
        return $this->hasManyThrough(CartItem::class, Cart::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function wallet() {
        return $this->hasOne(Wallet::class);
    }

    public function activeSubscriptions() {
        return $this->subscriptions()->where('subscriptions.is_active', true);
    }

    public function activatedPackages() {
        return $this->hasMany(Learnable::class)->where('is_active', true)->whereIn('type', ['public_package', 'private_package']);
    }

    public function activatedAttachments() {
        return $this->hasMany(Learnable::class)->where('is_active', true)->whereIn('type', ['attachment','attachment_lecture']);
    }

    public function activatedIndividuallySellableAttachments() {
        return $this->activatedAttachments()->where('is_individually_sellable', true);
    }

    public function chatRooms() {
        return $this->hasMany(ChatRoomMember::class, 'user_id');
    }
    public function totalUnRead():Attribute {
        return Attribute::make(get: function (){
            return $this->chatRooms()->sum('unread_count');
        });
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }
}
