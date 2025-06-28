<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/users',[ApiController::class, 'index'])->name('api.users.index');







Route::resource('users',UserController::class);
Route::resource('blogs',BlogController::class);
Route::resource('categories',CategoryController::class);
Route::resource('comments',CommentController::class);

Route::resource('tags',TagController::class);
Route::resource('likes',LikeController::class);


