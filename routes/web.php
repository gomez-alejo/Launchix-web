<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;


// Ruta para la página principal
Route::get('/launchix', function () {
    return view('launchix');
})->name('home');

Route::get('/launchix/blogs', function () {
    return view('blogs');
})->name('blogs');

// Rutas para autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta para la página de recuperación de contraseña
Route::get('/recuperacion', function () {
    return view('recuperacion');
})->name('recuperacion');

// Rutas para el registro de usuarios
Route::get('/registro', function () {
    return view('registro');
})->name('registro');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Rutas para la página de usuario (protegidas por autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/usuario', [UserController::class, 'showProfile'])->name('usuario');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/update-account-info', [UserController::class, 'updateAccountInfo'])->name('update-account-info');
    Route::delete('/eliminar-cuenta', [UserController::class, 'eliminarCuenta'])->name('eliminar-cuenta');
});

// Ruta para soporte técnico
Route::get('/soporte-tecnico', function () {
    return view('soporte-tecnico');
})->name('soporte-tecnico');



Route::put('/user-data/update', [UserController::class, 'updateUserData'])->name('user-data.update');

Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

Route::get('/usuario', [UserController::class, 'showUsuarioView'])->name('usuario');

    // En routes/web.php
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Rutas coments
Route::post('/comments/{comment}/update', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/usuario/blogs/{userId}', [UserController::class, 'getUserBlogs'])->name('usuario.blogs');