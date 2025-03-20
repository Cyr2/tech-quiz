<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

// Routes publiques pour l'authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Routes protégées
Route::middleware('\App\Http\Middleware\EnsureAuthenticated::class')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/create/user', [UserController::class, 'store']);
    Route::put('/update/user/{id}', [UserController::class, 'update']);
    Route::delete('/delete/user/{id}', [UserController::class, 'destroy']);
});