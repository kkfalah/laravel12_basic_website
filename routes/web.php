<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return redirect()->route('dashboard');
})->name('admin');

Route::get('/admin/dashboard', function () {
    return view('backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
// Route::get('/verify', [AdminController::class, 'verification'])->name('custom.verification.form');
// Route::post('/verify', [AdminController::class, 'verify'])->name('custom.verification.verify');

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile', [AdminController::class, 'profileStore'])->name('admin.profile.store');
    Route::post('/admin/password', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');
});
