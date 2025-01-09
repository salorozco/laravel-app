<?php

use App\Posts\Presentation\PostController;
use App\Users\Presentation\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/users', [UserController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/user/{userId}/post/{postId}/', [PostController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/user/{userId}/posts', [PostController::class, 'getPostsByUser']);
