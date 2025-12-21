<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PageController::class, 'index'])->name('index');



require __DIR__ . '/auth.php';

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

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
// Route::get('/verify', [AdminController::class, 'verification'])->name('custom.verification.form');
// Route::post('/verify', [AdminController::class, 'verify'])->name('custom.verification.verify');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    //Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/password/update', [AdminController::class, 'passwordUpdate'])->name('password.update');

    //Testimonials
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/testimonials', 'index')->name('testimonial.index');
        Route::get('/testimonials/create', 'create')->name('testimonial.create');
        Route::post('/testimonials/store', 'store')->name('testimonial.store');
        Route::get('/testimonials/{id}/edit', 'edit')->name('testimonial.edit');
        Route::patch('/testimonials/{id}/update', 'update')->name('testimonial.update');
        Route::delete('/testimonials/{id}/delete', 'destroy')->name('testimonial.destroy');
    });

    //Sliders
    Route::controller(SliderController::class)->group(function () {
        Route::get('/sliders', 'index')->name('slider.index');
        Route::get('/sliders/create', 'create')->name('slider.create');
        Route::post('/sliders/store', 'store')->name('slider.store');
        Route::get('/sliders/{id}/edit', 'edit')->name('slider.edit');
        Route::patch('/sliders/{id}/update', 'update')->name('slider.update');
        Route::delete('/sliders/{id}/delete', 'destroy')->name('slider.destroy');
    });


});
