<?php

use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\FirstLoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unauthorized', function () {
    return view('unauthorized')->name('unauthorized');
});

Route::get('first-login', [FirstLoginController::class, 'index'])->middleware(['auth'])->name('first-login');

Route::middleware('auth', FirstLoginMiddleware::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('items', ItemController::class);
});

require __DIR__.'/auth.php';
