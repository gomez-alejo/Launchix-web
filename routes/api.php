<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users',[ApiController::class, 'index'])->name('api.users.index');


Route::resource('/categories',CategoryController::class);



