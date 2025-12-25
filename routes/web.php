<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');



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

    //Title edits
    Route::post('/edit-titles/{id}',  [DashboardController::class, 'editTitle']);
    Route::post('/edit-sliders/{id}',  [SliderController::class, 'editSlider']);
    Route::post('/edit-video-bottom/{id}',  [DashboardController::class, 'midSectionVideoBottom']);

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

     //Mid Sections
    Route::controller(DashboardController::class)->group(function () {
        //Section One
        Route::get('/section-one', 'midSectionOneIndex')->name('section.one.index');
        Route::get('/section-one/edit', 'midSectionOneEdit')->name('section.one.edit');
        Route::patch('/section-one/update', 'midSectionOneUpdate')->name('section.one.update');
        
        //Section Two
        Route::get('/section-two', 'midSectionTwoIndex')->name('section.two.index');
        Route::get('/section-two/edit', 'midSectionTwoEdit')->name('section.two.edit');
        Route::patch('/section-two/update', 'midSectionTwoUpdate')->name('section.two.update');
        
        //Section Video
        Route::get('/section-video', 'midSectionVideoIndex')->name('section.video.index');
        Route::get('/section-video/edit', 'midSectionVideoEdit')->name('section.video.edit');
        Route::patch('/section-video/update', 'midSectionVideoUpdate')->name('section.video.update');

        //Section Video Bottom
        Route::get('/section-video-bottom', 'midSectionVideoBottomIndex')->name('section.video.bottom.index');
        Route::get('/section-video-bottom/{id}/edit', 'midSectionVideoBottomEdit')->name('section.video.bottom.edit');
        Route::patch('/section-video-bottom/{id}/update', 'midSectionVideoBottomUpdate')->name('section.video.bottom.update');
    });
    

    //Features
    Route::controller(FeatureController::class)->group(function () {
        Route::get('/features', 'index')->name('feature.index');
        Route::get('/features/create', 'create')->name('feature.create');
        Route::post('/features/store', 'store')->name('feature.store');
        Route::get('/features/{id}/edit', 'edit')->name('feature.edit');
        Route::patch('/features/{id}/update', 'update')->name('feature.update');
        Route::delete('/features/{id}/delete', 'destroy')->name('feature.destroy');
    });

    //FAQ
    Route::controller(FaqController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq.index');
        Route::get('/faq/create', 'create')->name('faq.create');
        Route::post('/faq/store', 'store')->name('faq.store');
        Route::get('/faq/{id}/edit', 'edit')->name('faq.edit');
        Route::patch('/faq/{id}/update', 'update')->name('faq.update');
        Route::delete('/faq/{id}/delete', 'destroy')->name('faq.destroy');
    });

});
