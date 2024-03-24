<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user', [\App\Http\Controllers\Auth\AuthController::class, 'user']);
});
