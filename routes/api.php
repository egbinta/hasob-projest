<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AssetAssignmentController;
use App\Http\Controllers\RegisterNotificationController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::put('update/profile/{id}', [UserController::class, 'updateProfile']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::get('profile', [UserController::class, 'profile']);
});

Route::group([
    'middleware' => 'api', 
    'prefix' => 'asset'
], function ($router) {
    Route::get('/', [AssetController::class, 'index']);
    Route::post('/store', [AssetController::class, 'store']);
    Route::put('/{id}', [AssetController::class, 'update']);
    Route::delete('/{id}', [AssetController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api', 
    'prefix' => 'vendor'
], function ($router) {
    Route::get('/', [VendorController::class, 'index']);
    Route::get('/item/{id}', [VendorController::class, 'getSingleItem']);
    Route::post('/store', [VendorController::class, 'store']);
    Route::put('/{id}', [VendorController::class, 'update']);
    Route::delete('/{id}', [VendorController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api', 
    'prefix' => 'asset-assignment'
], function ($router) {
    Route::get('/', [AssetAssignmentController::class, 'index']);
    Route::post('/store', [AssetAssignmentController::class, 'store']);
    Route::put('/{id}', [AssetAssignmentController::class, 'update']);
    Route::delete('/{id}', [AssetAssignmentController::class, 'destroy']);
});
