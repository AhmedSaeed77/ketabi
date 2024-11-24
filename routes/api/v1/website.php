<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Bank\BankController;
use App\Http\Controllers\Api\V1\Cart\CartController;
use App\Http\Controllers\Api\V1\Chat\ChatController;
use App\Http\Controllers\Api\V1\EducationalStage\EducationalStageController;
use App\Http\Controllers\Api\V1\Learnable\LearnableController;
use App\Http\Controllers\Api\V1\Learnable\LearnableStudentController;
use App\Http\Controllers\Api\V1\Learnable\LearnableTeacherController;
use App\Http\Controllers\Api\V1\Payment\PaymentController;
use App\Http\Controllers\Api\V1\Subject\SubjectController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\Wallet\WalletController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Structure\PrivacyTermsController;
use App\Http\Controllers\Api\V1\Structure\AboutUsController;
use App\Http\Controllers\Api\V1\Contact\ContactUsController;
use App\Http\Controllers\Api\V1\Infos\InfosController;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout' , 'logout');
    Route::post('refresh', 'refresh');
    Route::get('details', 'details');
    Route::post('/reset' , 'reset');
    Route::post('/resetUserconfirm' , 'resetUserconfirm');
    Route::post('/changePassword', 'changePassword');
});

Route::group(['prefix' => 'info'], function () {
    Route::get('educational-stages', [EducationalStageController::class, 'getInfo']);
    Route::get('subjects', [SubjectController::class, 'getInfo']);
    Route::get('banks', [BankController::class, 'getInfo']);
});

Route::group(['prefix' => 'search', 'controller' => UserController::class], function () {
    Route::post('students', 'searchStudents');
    Route::post('teachers', 'searchTeachers');
});

Route::group(['prefix' => 'content'], function () {
    Route::get('privacy-terms',PrivacyTermsController::class );
    Route::get('about-us',AboutUsController::class );
});
Route::post('contact-us',[ContactUsController::class,'store']);
Route::get('site/info',InfosController::class);
Route::group(['prefix' => 'global'], function () {
    Route::get('teachers/{id}', [UserController::class, 'showTeacher']);

    Route::group(['prefix' => 'profile', 'controller' => UserController::class], function () {
        Route::group(['prefix' => 'update'], function () {
            Route::post('/', 'updateProfile');
            Route::post('password', 'updatePassword');
            Route::post('bank', 'updateBank');
        });
    });

    Route::group(['prefix' => 'learnables', 'controller' => LearnableController::class], function () {
        Route::post('filter', [LearnableStudentController::class, 'filter']);

        Route::group(['prefix' => 'source/{learnable:id}'], function () {
            Route::get('/', 'getCourse');
            Route::get('learn', 'learnCourse');
        });
    });

    Route::group(['prefix' => 'chats', 'controller' => ChatController::class], function () {
        Route::post('provide', 'provide');
        Route::group(['prefix' => 'rooms'], function () {
            Route::get('/', 'getRooms');
            Route::group(['prefix' => '{room:id}'], function () {
                Route::get('/', 'getMessages');
                Route::post('load', 'loadMoreMessages');
                Route::post('send', 'send');
                Route::put('read', 'read');
            });
        });
        Route::group(['prefix' => 'go'], function () {
            Route::put('online', 'goOnline');
            Route::put('offline', 'goOffline');
        });
    });
});

Route::group(['prefix' => 'students', 'middleware' => 'only:student'], function () {
    Route::group(['prefix' => 'learnables', 'controller' => LearnableStudentController::class], function () {
        Route::group(['prefix' => 'my'], function () {
            Route::get('packages', 'getPackages');
            Route::get('attachments', 'getAttachments');
            Route::get('schedules', 'getSchedules');
        });
    });

    Route::group(['prefix' => 'cart', 'controller' => CartController::class], function () {
        Route::get('/', 'show');
        Route::post('add', 'add');
        Route::post('remove', 'remove');
    });

    Route::group(['prefix' => 'payment', 'controller' => PaymentController::class], function () {
        Route::post('initiate', 'initiate');
        Route::post('callback', 'callback')->name('payment.callback')->withoutMiddleware(['auth:api', 'only:student']);
        Route::get('query/{id}', 'query');
    });

});

Route::group(['prefix' => 'teachers', 'middleware' => 'only:teacher'], function () {
    Route::group(['prefix' => 'learnables', 'controller' => LearnableTeacherController::class], function () {
        Route::group(['prefix' => 'initiate/step'], function () {
            Route::post('one', 'initiateStepOne');
            Route::post('two', 'initiateStepTwo');
            Route::post('three', 'initiateStepThree');
        });

        Route::group(['prefix' => 'get'], function () {
            Route::get('packages', 'getPackages');
            Route::get('attachments', 'getAttachments');
            Route::get('lectures/{id}', 'getLectures');
            Route::get('schedules/{id?}', 'getSchedules');
        });

        Route::group(['prefix' => 'global'], function () {
            Route::post('create', 'create');
            Route::get('{id}', 'show');
            Route::post('{id}', 'update');
            Route::delete('{id}', 'delete');
        });
    });

    Route::group(['prefix' => 'wallet', 'controller' => WalletController::class], function () {
        Route::get('/', 'show');
        Route::post('withdraw', 'withdraw');
    });
});


/*
 *
 * TODO:
 * - notifications
 *
 */



