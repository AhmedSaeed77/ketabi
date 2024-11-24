<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Structure\AboutUsController;
use App\Http\Controllers\Dashboard\Structure\PrivacyTermsController;
use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Education\EducationStageController;
use App\Http\Controllers\Dashboard\Education\SubjectController;
use App\Http\Controllers\Dashboard\Users\TeachersContoller;
use App\Http\Controllers\Dashboard\Users\StudentsContoller;
use App\Http\Controllers\Dashboard\Info\InfoController;
use App\Http\Controllers\Dashboard\Package\PackageController;
use App\Http\Controllers\Dashboard\Contact\ContactControlller;
use App\Http\Controllers\Dashboard\Subscriptions\SubscriptionController;
use App\Http\Controllers\Dashboard\Payments\PaymentsController;
use App\Http\Controllers\Dashboard\Banks\BankController;
use App\Http\Controllers\Dashboard\Mangers\MangerController;
use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Dashboard\Wallets\WalletsController;
use App\Http\Controllers\Dashboard\Wallets\TransactionController;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, '_login']);

        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('/');
        Route::resource('users', UserController::class);
        Route::resource('educational-stages',EducationStageController::class)->except('show');
        Route::get('educational-stages/toggle',[EducationStageController::class,'toggle'])->name('toggleEducationStage');
        Route::resource('subjects',SubjectController::class)->except('show');
        Route::get('subjects/toggle',[SubjectController::class,'toggle'])->name('toggleSubject');
        Route::resource('teachers',TeachersContoller::class);
        Route::get('teacher/toggle',[TeachersContoller::class,'toggle'])->name('toggleTeacher');
        Route::resource('students',StudentsContoller::class);
        Route::get('student/toggle',[StudentsContoller::class,'toggle'])->name('toggleStudent');
        Route::resource('students',StudentsContoller::class);
        Route::get('infos/edit',[InfoController::class,'edit'])->name('infos.edit');
        Route::post('infos/update',[InfoController::class,'update'])->name('infos.update');
        Route::resource('packages',PackageController::class)->only('index','show','destroy');
        Route::get('package/toggle',[PackageController::class,'toggle'])->name('togglePackage');
        Route::group(['prefix' => 'structures'], function () {
            Route::resource('about-us-content', AboutUsController::class)->only('store','index');
            Route::resource('privacy-terms', PrivacyTermsController::class)->only('store','index');
        });
        Route::resource('contacts',ContactControlller::class)->only('index','show','destroy');
        Route::resource('subscriptions',SubscriptionController::class)->only('index','edit','update','destroy');
        Route::get('subscription/toggle',[SubscriptionController::class,'toggle'])->name('toggleSubscription');
        Route::resource('payments',PaymentsController::class)->only('index','show');
        Route::resource('banks',BankController::class);
        Route::resource('managers',MangerController::class)->except('show','index');
        Route::resource('roles',RoleController::class);
        Route::get('role/{id}/managers',[RoleController::class,'mangers'])->name('roles.mangers');
        Route::resource('settings' , SettingController::class)->only('edit','update');
        Route::post('update-password' , [SettingController::class,'updatePassword'])->name('update-password');
        Route::get('wallets' , [WalletsController::class,'index'])->name('wallets.index');
        Route::get('wallets/{id}/transactions' , [WalletsController::class,'transactions'])->name('wallets.transactions');
        Route::resource('transactions' , TransactionController::class)->only('edit','update');

    });
});
