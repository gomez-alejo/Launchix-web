<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::apiResources([
        'users' => UserController::class,
        'blogs' => BlogController::class,
        'categories' => CategoryController::class,
        'comments' => CommentController::class,
        'tags' => TagController::class,
        'likes' => LikeController::class,
    ]);

    // Ruta personalizada para unlike
    Route::delete('likes/{blog_id}/user/{user_id}', [LikeController::class, 'destroyByBlogAndUser'])
        ->name('api.likes.destroyByBlogAndUser');
});
