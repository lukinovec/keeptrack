<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\Library;
use App\Http\Livewire\RecentlyUpdated;
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

Route::middleware(["auth", "cors"])->group(function () {
    Route::get("/home", Dashboard::class)->name("home");
    Route::get("/recent", RecentlyUpdated::class)->name("recent");
    Route::get("/library/{type}", Library::class)->name("library");
});

Route::get("/login", Login::class)->name("login");
Route::get("/register", Register::class)->name("register");
