<?php

use App\Http\Controllers\Home\DailyController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PlansController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')->name('main.index');
        Route::get('/about', 'about')->name('main.about');
    });
});


Route::group(['middleware' => 'auth', 'prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::controller(DailyController::class)->prefix('daily')->group(function () {
        Route::get('/', 'index')->name('home.daily.index');
        Route::get('/create', 'create')->name('home.daily.create');
        Route::post('/', 'store')->name('home.daily.store');
        Route::post('{id}/doneChange', 'doneChange')->name('home.daily.doneChange');
        Route::get('{id}/edit', 'edit')->name('home.daily.edit');
        Route::patch('{id}', 'update')->name('home.daily.update');
        Route::delete('{id}', 'destroy')->name('home.daily.destroy');
        Route::post('/doneDestroy', 'doneDestroy')->name('home.daily.doneDestroy');
        Route::post('/allDestroy', 'allDestroy')->name('home.daily.allDestroy');

        // Мусорное ведро
        Route::get('/recycle_bin', 'recycle_bin')->name('home.daily.recycle_bin');
        Route::post('{id}/recycle_bin_restore', 'recycle_bin_restore')->name('home.daily.recycle_bin_restore');
        Route::post('{id}/recycle_bin_destroy', 'recycle_bin_destroy')->name('home.daily.recycle_bin_destroy');
        Route::post('/recycle_bin_restore_all', 'recycle_bin_restore_all')->name('home.daily.recycle_bin_restore_all');
        Route::post('/recycle_bin_destroy_all', 'recycle_bin_destroy_all')->name('home.daily.recycle_bin_destroy_all');
    });

    Route::controller(PlansController::class)->prefix('plans')->group(function () {
        Route::get('/', 'index')->name('home.plans.index');
        Route::get('/create', 'create')->name('home.plans.create');
        Route::post('/', 'store')->name('home.plans.store');
        Route::get('{id}/edit', 'edit')->name('home.plans.edit');
        Route::patch('{id}', 'update')->name('home.plans.update');
        Route::post('{id}/doneChange', 'doneChange')->name('home.plans.doneChange');
        Route::delete('{id}', 'destroy')->name('home.plans.destroy');

        // Мусорное ведро
        Route::get('/recycle_bin', 'recycle_bin')->name('home.plans.recycle_bin');
        Route::post('{id}/recycle_bin_restore', 'recycle_bin_restore')->name('home.plans.recycle_bin_restore');
        Route::post('{id}/recycle_bin_destroy', 'recycle_bin_destroy')->name('home.plans.recycle_bin_destroy');
    });
});

Auth::routes();
