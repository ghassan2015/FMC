
<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Constants\ConstantController;
use App\Http\Controllers\Api\V1\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'lang'], function () {

    Route::group(['prefix' => 'v1'], function () {

        Route::get('contstants',[ConstantController::class,'index']);
        Route::get('settings',[ConstantController::class,'getSettings']);


        Route::group(['prefix' => 'auth'], function () {

            Route::post('/register', [AuthController::class, 'Register']);
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/forget-password', [AuthController::class, 'forgotPassword']);
            Route::post('/check-code-verification', [AuthController::class, 'checkCodeVerification']);
            Route::post('/new-password', [AuthController::class, 'newPassword']);
            Route::post('/social-Login', [AuthController::class, 'socialLogin']);
            Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        });

           Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'profile'], function () {
                Route::get('/', [ProfileController::class, 'getProfile']);
                Route::post('/update', [ProfileController::class, 'update']);
                Route::post('/change-language', [ProfileController::class, 'changeLanguage']);
                Route::post('/change-password', [ProfileController::class, 'changePassword']);
                Route::post('/delete-account', [ProfileController::class, 'deleteAccount']);
            });

        });


    });
});
