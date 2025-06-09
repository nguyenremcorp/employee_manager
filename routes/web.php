<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::middleware(['auth.state'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Role admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.list');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');    
});


// Role user
Route::prefix('user')->middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/show/{user}', [UserController::class, 'show'])->name('user.show');
    Route::patch('/user/update/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
