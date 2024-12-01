<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EarthquakeController;
use App\Http\Controllers\HeatController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;

Route::middleware(['auth'])->get('/landing', function () {
    return view('landing');
})->name('landing');

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
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

Route::get('/reportTemp', [WeatherController::class, 'ShowWeather'])->name('report');
Route::get('/heat', [HeatController::class, 'showHeat'])->name('heat');

Route::get('/admin/dashboard', [AdminController::class, 'adminview'])->name('dashboard');
Route::get('/admin/users', [AdminController::class, 'manageuser'])->name('manageuser');
Route::delete('/delete/{id}', [AdminController::class, 'deleteuser'])->name('delete');

Route::get('/report', [ReportController::class, 'create'])->name('reports.create');
Route::post('/report', [ReportController::class, 'store'])->name('reports.store');
Route::get('/reportHome', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
Route::put('/reports/{report}', [ReportController::class, 'update'])->name('reports.update');
Route::delete('/reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');


// Route::middleware(['auth'])->get('/landing', function (){
//     return view('landing');
// })->name('landing');
