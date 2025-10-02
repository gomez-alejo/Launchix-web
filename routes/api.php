<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;

use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {

    Route::resource('users', UserController::class)->names('api.users');
    Route::resource('blogs', BlogController::class)->names('api.blogs');
    Route::resource('categories', CategoryController::class)->names('api.categories');
    Route::resource('comments', CommentController::class)->names('api.comments');
    Route::resource('tags', TagController::class)->names('api.tags');
    Route::resource('likes', LikeController::class)->names('api.likes');

    // Ruta personalizada para unlike
    Route::delete('likes/{blog_id}/user/{user_id}', [LikeController::class, 'destroyByBlogAndUser'])
        ->name('api.likes.destroyByBlogAndUser');

});
