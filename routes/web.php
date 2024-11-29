<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\HeatController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/report', [WeatherController::class, 'ShowWeather'])->name('report');
Route::get('/heat', [HeatController::class, 'showHeat'])->name('heat');