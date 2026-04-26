<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Public\CommitteeController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\StadiumController;
use App\Http\Controllers\Public\TripController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CommitteeController as AdminCommitteeController;
use App\Http\Controllers\Admin\TripController as AdminTripController;
use App\Http\Controllers\Admin\StadiumBookingController;
use App\Http\Controllers\Admin\TripBookingController;
use Illuminate\Support\Facades\Route;
// Admin Healthcare Controllers (تأكد من المسارات هنا)
use App\Http\Controllers\Admin\Healthcare\HealthcareController as AdminHealthcareController;
use App\Http\Controllers\Public\HealthcareController as PublicHealthcareController;
use App\Http\Controllers\Admin\Healthcare\DoctorController;
use App\Http\Controllers\Admin\Healthcare\HospitalController;
use App\Http\Controllers\Admin\Healthcare\LabController;
use App\Http\Controllers\Admin\Healthcare\PharmacyController;


// ─── Auth ─────────────────────────────────────────────────────────────────────

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Public Website ───────────────────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
});

Route::get('/committees', [CommitteeController::class, 'index'])->name('committees');

Route::prefix('trips')->name('trips.')->group(function () {
    Route::get('/', [TripController::class, 'index'])->name('index');
    Route::get('/{slug}', [TripController::class, 'show'])->name('show');
});

Route::prefix('stadium')->name('stadium.')->group(function () {
    Route::get('/', [StadiumController::class, 'index'])->name('index');
    Route::post('/book', [StadiumController::class, 'store'])->name('book');
});


Route::get('/healthcare', [PublicHealthcareController::class, 'index'])->name('healthcare.index');

// ─── Admin Dashboard ──────────────────────────────────────────────────────────

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // News
    Route::resource('news', AdminNewsController::class)->except(['show']);
    Route::patch('news/{news}/toggle-publish', [AdminNewsController::class, 'togglePublish'])
        ->name('news.toggle-publish');

    // Committees
    Route::resource('committees', AdminCommitteeController::class)->except(['show']);

    // Trips
    Route::resource('trips', AdminTripController::class)->except(['show']);

    // Stadium Bookings
    Route::get('bookings/stadium', [StadiumBookingController::class, 'index'])
        ->name('bookings.stadium');
    Route::patch('bookings/stadium/{booking}/status', [StadiumBookingController::class, 'updateStatus'])
        ->name('bookings.stadium.status');

    // Trip Bookings
    Route::get('bookings/trips', [TripBookingController::class, 'index'])
        ->name('bookings.trips');
    Route::patch('bookings/trips/{booking}/status', [TripBookingController::class, 'updateStatus'])
        ->name('bookings.trips.status');


    

   // Healthcare Admin Section (تم التصحيح هنا)
    Route::prefix('healthcare')->name('healthcare.')->group(function () {
        Route::get('/', [AdminHealthcareController::class, 'index'])->name('index'); 
        Route::get('/dashboard', [AdminHealthcareController::class, 'index'])->name('dashboard'); 
        Route::resource('doctors', DoctorController::class);
        Route::resource('hospitals', HospitalController::class);
        Route::resource('pharmacies', PharmacyController::class);
        Route::resource('labs', LabController::class);
    });

});

