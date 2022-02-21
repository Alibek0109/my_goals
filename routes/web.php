<?php

use App\Http\Controllers\Home\DailyController;
use App\Http\Controllers\Home\HomeController;
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
        Route::get('{id}/edit', 'edit')->name('home.daily.edit');
        Route::patch('{id}', 'update')->name('home.daily.update');
        Route::delete('{id}', 'destroy')->name('home.daily.destroy');
    });

});

Auth::routes();
