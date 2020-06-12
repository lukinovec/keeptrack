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

Route::get('', 'PagesController@index')->middleware('auth');
Route::get('home', function () {
    return redirect('');
})->middleware('auth');

Route::post('search', 'PagesController@search')->middleware('auth');

Route::post('sendMovie', 'MovieController@index')->middleware('auth');

Route::post('sendBook', 'BookController@index')->middleware('auth');

Route::get('results', 'PagesController@results')->middleware('auth');

Route::get('tbd', 'PagesController@tbd')->middleware('auth');

Route::get('movielist', 'MovieController@list')->middleware('auth');

Route::get('booklist', 'BookController@list')->middleware('auth');

Route::post('updateprogress/{id}', 'MovieController@updateProgress')->middleware('auth')->name('updateProgress');

Route::post('updateprogressbooks/{id}', 'BookController@updateProgress')->middleware('auth')->name('updateProgressBooks');

Auth::routes();
