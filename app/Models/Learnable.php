<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Learnable extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    protected function imageUrl() : Attribute {
        return Attribute::get(fn () => $this->image !== null ? url($this->image) : null);
    }

    protected function typeValue() : Attribute {
        return Attribute::get(fn () => __('db.learnables.'.$this->type));
    }

    public function parent() {
        return $this->belongsTo(Learnable::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Learnable::class, 'parent_id');
    }

    public function categories() {
        return $this->children()->where('type', 'category');
    }

    public function lectures() {
        return $this->children()->whereIn('type', ['live_lecture', 'recorded_lecture']);
    }

    public function categorizedLectures() {
        return $this->lectures()->whereHas('parent', function ($query) {
            $query->where('type', 'category');
        });
    }

    public function uncategorizedLectures() {
        return $this->lectures()->whereHas('parent', function ($query) {
            $query->whereIn('type', ['public_package', 'private_package']);
        });
    }

    public function lecturesCount() : Attribute {
        return Attribute::get(function () {
            if (!in_array($this->type, ['public_package', 'private_package'])) {
                return null;
            }

            return $this->where(function ($query) {
                $query->where('parent_id', $this->id);
                $query->orWhere(function ($query) {
                    $query->whereHas('parent', function ($query) {
                        $query->where('type', 'category');
                        $query->where('parent_id', $this->id);
                    });
                });
            })
            ->whereIn('type', ['live_lecture', 'recorded_lecture'])
            ->count();
        });
    }

    public function isDeletable() : Attribute {
        return Attribute::get(function () {
            if (!in_array($this->type, ['public_package', 'private_package', 'attachment']))
                return true;

            return !$this->activeSubscriptions()?->exists();
        });
    }

    public function isSubscribed() : Attribute {
        return Attribute::get(function () {
            return $this->activeSubscriptions()->where('subscriptions.user_id', auth('api')->id())->exists();
        });
    }

    public function subscriptionEndsAt() : Attribute {
        return Attribute::get(function () {
            if (!$this->is_subscribed || $this->type == 'attachment') {
                return null;
            }
            $endsAt = $this->activeSubscriptions()->where('subscriptions.user_id', auth('api')->id())->first()->ends_at;
            $now = Carbon::now();
            $diff = Carbon::parse($now)->diffInDays($endsAt, false);
            if ($diff == 0) {
                return __('messages.subscription will be ended today');
            } elseif($diff == 1) {
                return __('messages.subscription will be in a day');
            } else {
                return __('messages.subscription will be ended in days', ['days' => $diff]);
            }
        });
    }

    public function attachments() {
        return $this->children()->where('type', 'attachment');
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function educationalStage() {
        return $this->belongsTo(EducationalStage::class);
    }

    public function students() {
        return $this->belongsToMany(User::class);
    }

    public function subscriptions() {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscriptions() {
        return $this->subscriptions()->where('subscriptions.is_active', true);
    }
    public function getTypeNameAttribute(){
        if ($this->type=='public_package')
            return __('dashboard.public_package');
        elseif ($this->type=='private_package')
            return __('dashboard.private_package');
        elseif ($this->type=='recorded_lecture')
            return __('dashboard.recorded_lecture');
        elseif ($this->type=='live_lecture')
            return __('dashboard.live_lecture');
        elseif ($this->type=='attachment')
            return __('dashboard.attachment');
        elseif ($this->type=='attachment_lecture')
            return __('dashboard.attachment_lecture');
    }
    public function getSellableAttribute(){
        if ($this->is_individually_sellable==1)
            return __('dashboard.Yes');
        else
            return __('dashboard.No');
    }
}
