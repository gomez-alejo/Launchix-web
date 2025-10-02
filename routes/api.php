<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);
Route::resource('blogs', BlogController::class);
Route::resource('categories', CategoryController::class);
Route::resource('comments', CommentController::class);
Route::resource('tags', TagController::class);
Route::resource('likes', LikeController::class);

// Ruta personalizada para unlike
Route::delete('likes/{blog_id}/user/{user_id}', [LikeController::class, 'destroyByBlogAndUser'])
    ->name('likes.destroyByBlogAndUser');
