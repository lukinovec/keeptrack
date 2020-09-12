<?php

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

Route::get("/", function () {
    return view("welcome");
})->name("welcome");

Route::middleware(["auth", "cors"])->group(function () {
    Route::get("/home", function () {
        return view("dashboard");
    })->name("home");

    Route::get("/results", function () {
        return view("found-results");
    })->name("found-results");
});



Route::get("/login", function () {
    return view("login");
})->name("login");

Route::get("/register", function () {
    return view("register");
})->name("register");
// Route::post('/results/goodreads', 'BookController@fetch')->middleware('cors');
