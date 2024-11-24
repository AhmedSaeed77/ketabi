<?php

namespace App\Providers;

use App\Repository\BankRepositoryInterface;
use App\Repository\CartItemRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\ChatRoomMemberRepositoryInterface;
use App\Repository\ChatRoomMessageRepositoryInterface;
use App\Repository\ChatRoomRepositoryInterface;
use App\Repository\ContactRepositoryInterface;
use App\Repository\EducationalStageRepositoryInterface;
use App\Repository\Eloquent\BankRepository;
use App\Repository\Eloquent\CartItemRepository;
use App\Repository\Eloquent\CartRepository;
use App\Repository\Eloquent\ChatRoomMemberRepository;
use App\Repository\Eloquent\ChatRoomMessageRepository;
use App\Repository\Eloquent\ChatRoomRepository;
use App\Repository\Eloquent\ContactRepository;
use App\Repository\Eloquent\EducationalStageRepository;
use App\Repository\Eloquent\InfoRepository;
use App\Repository\Eloquent\LearnableRepository;
use App\Repository\Eloquent\LearnableUserRepository;
use App\Repository\Eloquent\ManagerRepository;
use App\Repository\Eloquent\PaymentRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\StructureRepository;
use App\Repository\Eloquent\StudentRepository;
use App\Repository\Eloquent\SubjectRepository;
use App\Repository\Eloquent\SubscriptionRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\WalletRepository;
use App\Repository\Eloquent\WalletTransactionRepository;
use App\Repository\InfoRepositoryInterface;
use App\Repository\LearnableRepositoryInterface;
use App\Repository\LearnableUserRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\StudentRepositoryInterface;
use App\Repository\SubjectRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\WalletRepositoryInterface;
use App\Repository\WalletTransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(EducationalStageRepositoryInterface::class, EducationalStageRepository::class);
        $this->app->singleton(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->singleton(InfoRepositoryInterface::class, InfoRepository::class);
        $this->app->singleton(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->singleton(StructureRepositoryInterface::class, StructureRepository::class);
        $this->app->singleton(WalletRepositoryInterface::class, WalletRepository::class);
        $this->app->singleton(WalletTransactionRepositoryInterface::class, WalletTransactionRepository::class);
        $this->app->singleton(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(LearnableRepositoryInterface::class, LearnableRepository::class);
        $this->app->singleton(LearnableUserRepositoryInterface::class, LearnableUserRepository::class);
        $this->app->singleton(CartRepositoryInterface::class, CartRepository::class);
        $this->app->singleton(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->singleton(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->singleton(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->singleton(ChatRoomRepositoryInterface::class, ChatRoomRepository::class);
        $this->app->singleton(ChatRoomMemberRepositoryInterface::class, ChatRoomMemberRepository::class);
        $this->app->singleton(ChatRoomMessageRepositoryInterface::class, ChatRoomMessageRepository::class);
        $this->app->singleton(BankRepositoryInterface::class, BankRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
