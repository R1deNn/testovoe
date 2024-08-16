<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// << Изменение пароля

    Route::post('/change-password-telegram', [ChangePasswordController::class, 'telegram'])->name('change-password-telegram');
    Route::post('/change-password-telegram-submit', [ChangePasswordController::class, 'telegramSubmit'])->name('change-password-telegram-submit');

    Route::post('/change-password-email', [ChangePasswordController::class, 'email'])->name('change-password-email');
    Route::post('/change-password-email-submit', [ChangePasswordController::class, 'emailSubmit'])->name('change-password-email-submit');

    Route::post('/change-password-tel', [ChangePasswordController::class, 'tel'])->name('change-password-tel');
    Route::post('/change-password-tel-submit', [ChangePasswordController::class, 'telSubmit'])->name('change-password-tel-submit');

    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

// >> Изменение пароля

require __DIR__.'/auth.php';
