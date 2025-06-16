<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users',[ApiController::class, 'index'])->name('api.users.index');








Route::resource('categories',CategoryController::class);
Route::resource('comments',CommentController::class);
Route::resource('comments',CommentController::class);


