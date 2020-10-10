<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Login;
use App\Http\Livewire\Register;
use App\Http\Livewire\Welcome;
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

    // Route::get("/results", )->name("found-results");
});

Route::get("/login", Login::class)->name("login");
Route::get("/register", Register::class)->name("register");
// Route::post('/results/goodreads', 'BookController@fetch')->middleware('cors');
