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

// Route::get('results', 'PagesResultsController@results')->middleware('auth');

Route::get('tbd', 'PagesController@tbd')->middleware('auth');

Route::get('movielist', 'MovieListController@index')->middleware('auth');

Route::get('booklist', 'BookListController@index')->middleware('auth');

Route::post('updateprogress/{id}', 'MovieProgressController@update')->middleware('auth')->name('updateProgress');

Route::post('updateprogressbooks/{id}', 'BookProgressController@update')->middleware('auth')->name('updateProgressBooks');

Auth::routes();
