<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users',[ApiController::class, 'index'])->name('api.users.index');

Route::resource('blogs',BlogController::class);


