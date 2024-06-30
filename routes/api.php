<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\RegistrationController;

Route::prefix('v1')->group(function(){
    Route::apiResource('users',UserController::class);
    Route::post('login',[AuthController::class,'login']);
    Route::middleware('custom.auth')->group(function(){
        Route::apiResource('trainings',TrainingController::class);
        Route::apiResource('registrations',RegistrationController::class);
    });
});