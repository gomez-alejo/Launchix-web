<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Ruta para la página principal
Route::get('/launchix', function () {
    return view('launchix');
})->name('home');

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
