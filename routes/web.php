<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

// Public Controllers
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\CommitteeController;
use App\Http\Controllers\Public\TripController;
use App\Http\Controllers\Public\StadiumController;
use App\Http\Controllers\Public\HealthcareController as PublicHealthcareController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;

use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CommitteeController as AdminCommitteeController;

use App\Http\Controllers\Admin\Trip\TripController as AdminTripController;
use App\Http\Controllers\Admin\Trip\TripBookingController;

use App\Http\Controllers\Admin\Stadium\StadiumBookingController;

use App\Http\Controllers\Admin\Healthcare\HealthcareController as AdminHealthcareController;
use App\Http\Controllers\Admin\Healthcare\DoctorController;
use App\Http\Controllers\Admin\Healthcare\HospitalController;
use App\Http\Controllers\Admin\Healthcare\LabController;
use App\Http\Controllers\Admin\Healthcare\PharmacyController;

use App\Http\Controllers\Admin\ServiceController as ServiceController;
use App\Http\Controllers\Public\ServiceController as PublicServiceController;

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| News
|--------------------------------------------------------------------------
*/

Route::prefix('news')->name('news.')->group(function () {

    Route::get('/', [NewsController::class, 'index'])
        ->name('index');

    Route::get('/{slug}', [NewsController::class, 'show'])
        ->name('show');

});

/*
|--------------------------------------------------------------------------
| Committees
|--------------------------------------------------------------------------
*/

Route::get('/committees', [CommitteeController::class, 'index'])
    ->name('committees.index');

Route::get('/committees/{id}', [CommitteeController::class, 'show'])
    ->name('committees.show');

/*
|--------------------------------------------------------------------------
| Trips
|--------------------------------------------------------------------------
*/

Route::prefix('trips')->name('trips.')->group(function () {

    Route::get('/', [TripController::class, 'index'])
        ->name('index');

    Route::get('/{slug}', [TripController::class, 'show'])
        ->name('show');

    Route::post('/{trip}/book', [TripController::class, 'book'])
        ->name('book');

    Route::get('/confirmation/{booking}', [TripController::class, 'confirmation'])
        ->name('confirmation');    

});

/*
|--------------------------------------------------------------------------
| Stadium
|--------------------------------------------------------------------------
*/

Route::prefix('stadium')->name('stadium.')->group(function () {

    Route::get('/', [StadiumController::class, 'index'])
        ->name('index');

    Route::post('/book', [StadiumController::class, 'store'])
        ->name('book');

    Route::get('/slots', [StadiumController::class, 'slots'])
        ->name('slots');

});

/*
|--------------------------------------------------------------------------
| Healthcare
|--------------------------------------------------------------------------
*/

Route::get('/healthcare', [PublicHealthcareController::class, 'index'])
    ->name('healthcare.index');



    /*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/
Route::prefix('services')->name('services.')->group(function () {

    Route::get('/', [PublicServiceController::class, 'index'])->name('index');

    Route::get('/service{service}', [PublicServiceController::class, 'show'])->name('show');

});
/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingsController::class, 'update'])
        ->name('settings.update');

    /*
    |--------------------------------------------------------------------------
    | News
    |--------------------------------------------------------------------------
    */

    Route::resource('news', AdminNewsController::class)
        ->except(['show']);

    Route::patch('news/{news}/toggle-publish', [AdminNewsController::class, 'togglePublish'])
        ->name('news.toggle-publish');

    /*
    |--------------------------------------------------------------------------
    | Committees
    |--------------------------------------------------------------------------
    */

    Route::resource('committees', AdminCommitteeController::class)
        ->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Trips
    |--------------------------------------------------------------------------
    */

    Route::resource('trips', AdminTripController::class)
        ->except(['show']);

    /*
    |--------------------------------------------------------------------------
    | Trip Bookings
    |--------------------------------------------------------------------------
    */

    Route::get('bookings/trips', [TripBookingController::class, 'index'])
        ->name('bookings.trips');

    Route::patch('bookings/trips/{booking}/status', [TripBookingController::class, 'updateStatus'])
        ->name('bookings.trips.status');

    /*
    |--------------------------------------------------------------------------
    | Stadium
    |--------------------------------------------------------------------------
    */

    Route::prefix('stadium')->name('stadium.')->group(function () {

        Route::get('bookings', [StadiumBookingController::class, 'index'])
            ->name('bookings');

        Route::patch('bookings/{booking}/status', [StadiumBookingController::class, 'updateStatus'])
            ->name('bookings.status');

    });

    /*
    |--------------------------------------------------------------------------
    | Healthcare
    |--------------------------------------------------------------------------
    */

    Route::prefix('healthcare')->name('healthcare.')->group(function () {

        Route::get('/', [AdminHealthcareController::class, 'index'])
            ->name('index');

        Route::get('/dashboard', [AdminHealthcareController::class, 'index'])
            ->name('dashboard');

        Route::resource('doctors', DoctorController::class);

        Route::resource('hospitals', HospitalController::class);

        Route::resource('pharmacies', PharmacyController::class);

        Route::resource('labs', LabController::class);

    });

            Route::prefix('services')->name('services.')->group(function () {

            Route::get('/', [ServiceController::class, 'index'])->name('index');

            Route::get('/create', [ServiceController::class, 'create'])->name('create');

            Route::post('/store', [ServiceController::class, 'store'])->name('store');

            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');

            Route::put('/{service}', [ServiceController::class, 'update'])->name('update');

            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');

        });
    // Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

});