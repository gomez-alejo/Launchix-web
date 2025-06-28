<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/usersApi',[UserController::class, 'index'])->name('api.users');
Route::get('/blogsApi',[BlogController::class, 'indexApi'])->name('api.blogs');
Route::get('/commentsApi',[CommentController::class, 'indexApi'])->name('api.comments');


