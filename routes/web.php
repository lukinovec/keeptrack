<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\Library;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", Welcome::class)->name("welcome");

// Nepříhlášení uživatelé budou přesměrování na login
Route::middleware(["auth", "cors"])->group(function () {
    Route::get("/home", Dashboard::class)->name("home");
    Route::get("/library", Library::class)->name("library");
});


// Příhlášení uživatelé budou přesměrování na home
Route::middleware(["guest"])->group(function () {
    Route::get("/login", Login::class)->name("login");
    Route::get("/register", Register::class)->name("register");
    Route::get("/forgot-password", ForgotPassword::class)->name("forgot-password");
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});
