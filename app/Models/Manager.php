<?php

namespace App\Models;

use App\Http\Traits\HasIsActive;
use App\Http\Traits\HasPassword;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Manager extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions, HasPassword, HasIsActive;

    protected $guarded = [];
    protected $hidden = [
        'password',
    ];
//    protected $appends = ['rate'];

    protected function imageUrl() : Attribute {
        return Attribute::get(fn () => $this->image !== null ? url($this->image) : null);
    }

    protected function cvUrl() : Attribute {
        return Attribute::get(fn () => $this->cv !== null ? url($this->cv) : null);
    }

    public function rate() : Attribute {
        return Attribute::get(function () {
            return $this->rates?->avg('rating') ?? 0;
        });
    }

    public function isFavourite() : Attribute {
        return Attribute::get(function () {
            return auth('api')->check() ? $this->favourites()->where('user_id', auth('api')->id())->exists() : null;
        });
    }

    public function favouriteId() : Attribute {
        return Attribute::get(function () {
            return auth('api')->check() ? $this->favourites()->where('user_id', auth('api')->id())->first()?->id : null;
        });
    }

//    public function experience()
//    {
//        return $this->belongsTo(Experience::class);
//    }

    public function educationalStages()
    {
        return $this->belongsToMany(EducationalStage::class, 'manager_educational_stages');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'manager_subjects');
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function files()
    {
        return $this->hasMany(ManagerFile::class);
    }

    public function wallet() {
        return $this->morphOne(Wallet::class, 'walletable');
    }

    public function rates() {
        return $this->hasManyThrough(UserRating::class, Package::class);
    }

    public function lectures() {
        return $this->hasMany(Lecture::class);
    }

    public function recordedLectures() {
        return $this->hasMany(Lecture::class)->where('is_live', false);
    }

    public function popularPackages() {
        return $this->packages()->withCount('subscriptions')->orderByDesc('subscriptions_count')->limit(3);
    }

    public function videos() {
        return $this->lectures()->where('show_in_profile', true);
    }

    public function recentVideos() {
        return $this->videos()->orderByDesc('id')->limit(3);
    }

    public function favourites(): MorphMany
    {
        return $this->morphMany(Favourite::class, 'favouritable');
    }

    public function profileFiles() {
        return $this->files()->where('show_in_profile', true);
    }

}
