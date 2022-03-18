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

Route::get('/mahasiswa', 'mhsController@index');
Route::get('/myprofil', 'mhsController@profil');
Route::get('/portfolio', 'mhsController@pf');
Route::get('/dosen', 'dosenController@index');
Route::redirect('/infomhs', 'mahasiswa');

route::get('/dataMhs', 'mhsController@index');

Auth::routes();
// var_dump(Auth::users());
// die();
// Auth::check();

// Auth();
Route::resource('/prediction', PredictionController::class);
Route::resource('/user', UserController::class);
Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
