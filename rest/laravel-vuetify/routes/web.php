<?php

use App\Http\Controllers\Web\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::get('/{post}', [PostsController::class, 'show'])->name('posts.show');
