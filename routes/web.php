<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EarthquakeController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('landing');
});

Route::get('/landing', [AuthController::class, 'landing'])->name('landing');
Route::get('/reportTemp', [WeatherController::class, 'showWeather'])->name('report');

Route::get('/login', [AuthController::class, 'Loginform'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'Registerform'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

Route::get('/profile/edit', [AuthController::class, 'editProfileForm'])->name('profile.edit');
Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::delete('/profile-picture/delete', [AuthController::class, 'deleteProfilePicture'])->name('profile.picture.delete');
