<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EarthquakeController;
use App\Http\Controllers\HeatController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->get('/landing', function () {
    return view('landing');
})->name('landing');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('landing'); // Redirect to landing if logged in
    }
    return view('login'); // Show login page if not logged in
});

Route::get('/login', [AuthController::class, 'Loginform'])->name('login');
Route::get('/landing', [AuthController::class, 'landing'])->name('landing');
Route::post('/login/submit', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'Registerform'])->name('register');
Route::post('/register/submit', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/report', [WeatherController::class, 'ShowWeather'])->name('report');
Route::get('/heat', [HeatController::class, 'showHeat'])->name('heat');


// Route::middleware(['auth'])->get('/landing', function (){
//     return view('landing');
// })->name('landing');
