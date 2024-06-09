<?php

use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/posts', [PostsController::class, 'index']);
Route::post('/posts', [PostsController::class, 'store']);
Route::get('/posts/{post}', [PostsController::class, 'show']);
Route::get('/posts/{post}/comments', [PostsController::class, 'showComments']);
Route::delete('/posts/{post}', [PostsController::class, 'destroy']);

Route::post('/comments', [CommentsController::class, 'store']);
