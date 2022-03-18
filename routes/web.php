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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::resource('/prediction',PredictionController::class);
// Route::resource('/confution-matrix',analyticController::class);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/confution-matrix', 'HomeController@confutionMatrix')->name('c-matrix');
Route::get('/normalize-data', 'HomeController@normalizeData')->name('n-data');
Route::get('/evalution-data', 'HomeController@evalData')->name('e-data');