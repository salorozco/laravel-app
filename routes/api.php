<?php

use App\Users\Presentation\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);
