<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Traits\Responser;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    use Responser;

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        #===================[ Dashboard Gates ]===================#
//        Gate::define('edit-role', function ($user, $role) {
//            return $role->is_editable;
//        });
//
        Gate::define('delete-role', function ($user, $role) {
            return  $role->managers->count() == 0;
        });
//
//        Gate::define('access-role', function ($user, $role = null) {
//            return $role !== null
//                ? Response::allow()
//                : Response::denyWithStatus(404);
//        });

        Gate::define('delete-experience', function ($user, $experience = null) {
            return !$experience->whereHas('managers', function ($query) {
                $query->whereHas('packages', function ($query) {
                    $query->whereHas('groups', function ($query) {
                        $query->whereHas('subscriptions', function ($query) {
                            $query->where('is_active', true);
                        });
                    });
                });
            })->exists()
                ?  Response::allow()
                : Response::denyWithStatus(401);
        });

//        Gate::define('delete-manager', function ($user) {
//            return
//                !$user->packages()?->whereHas('groups', function ($query) {
//                    $query->whereHas('subscriptions', fn ($query) => $query->where('is_active', true));
//                })->exists()
//                && !$user->files()?->whereHas('subscriptions', fn ($query) => $query->where('is_active', true))->exists()
//                ? Response::allow()
//                : Response::denyWithStatus(401);
//        });
        Gate::define('delete-manager',function ($user,$manager){
            return $user->id!=$manager->id ? Response::allow():Response::denyWithStatus(401);
        });

        Gate::define('delete-educational-stage', function ($user, $educationalStage) {
            return !$educationalStage->students()?->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });
        Gate::define('update-transaction',function ($user,$transaction){
            return $transaction->type==='pending_withdrawal'?Response::allow():Response::deny();
        });
//        Gate::define('delete-subject', function ($user, $subject) {
//            return
//
//                !$subject->managers()->exists()
//                && !$subject->packages()?->whereHas('groups', function ($query) {
//                    $query->whereHas('subscriptions', fn ($query) => $query->where('is_active', true));
//                })->exists()
//
//                ? Response::allow()
//                : Response::denyWithStatus(401);
//        });

        Gate::define('delete-lecture', function ($user, $lecture) {
            return
                $lecture->package->manager_id == $user->id
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-file', function ($user, $file) {
            return
                $file->manager->id == $user->id &&
                !$file->subscriptions()?->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-package', function ($user, $package) {
            return
                !$package->subscriptions()->exists()
                &&  !$package->attachments()->where('price', '>', 0)->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-package_group', function ($user, $package_group) {
            return
                !$package_group->subscriptions()->where('is_active', true)
                &&  !$package_group->files()->where('price', '>', 0)->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-package_category', function ($user, $package_category) {
            return
                !$package_category->whereHas('packages', function ($query) {
                    $query->whereHas('groups', function ($query) {
                        $query->whereHas('subscriptions', fn ($query) => $query->where('is_active', true));
                    });
                })->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-rate_question', function ($user, $rate_question) {
            return
                !$rate_question->userRating()?->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        Gate::define('delete-user', function ($user, $specific_user) {
            return
                !$specific_user->subscriptions()?->exists()
                ? Response::allow()
                : Response::denyWithStatus(401);
        });

        #===================[ End Dashboard Gates ]===================#

        #===================[ Start API Gates ]===================#

        Gate::define('access-room', function ($user, $room) {
            return $room->members?->contains('user_id', auth('api')->id());
        });

        #===================[ End API Gates ]===================#

    }
}
