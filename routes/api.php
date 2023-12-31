<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\MerchantController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function (){
//    return response()->json(['welcome']);
//});

/**
 * Authentication Routes
 */
Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::post('/auth/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:api')->group(function (): void {
    /**
     * Card Endpoints
     */
    Route::get('/card/{uuid}', [CardController::class, 'single']);
    Route::post('/card/create', [CardController::class, 'create']);

    /**
     * Merchant Endpoints
     */
    Route::get('/merchants/{uuid}', [MerchantController::class, 'single']);
    Route::post('/merchants/create', [MerchantController::class, 'create']);

    /**
     * Tasks Endpoints
     */
    Route::post('/task/create', [TaskController::class, 'create']);
    Route::post('/task/{uuid}/update', [TaskController::class, 'update']);

    /**
     * User Task Endpoint
     */
    Route::get('/user/{uuid}/finished-tasks/latest', [UserController::class, 'finishedTasksByMerchant']);
});
