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
})->name('home.guest');
Auth::routes();

Route::resource('/prediction',PredictionController::class);
Route::resource('/user',UserController::class);
Route::POST('/cekemailuser','UserController@cekEmail')->name('cek_emailUser');
// Route::resource('/confution-matrix',analyticController::class);
Route::get('/home', 'HomeController@index')->name('home.admin');

// Prediction
Route::get('/confution-matrix', 'HomeController@confutionMatrix')->name('c-matrix');
Route::get('/prediction-tambah', 'HomeController@tambahData')->name('tambah');
Route::get('/set-k', 'HomeController@set_k')->name('set-k');
Route::get('/euclidean-distance-data', 'HomeController@euclideanDistanceData')->name('ed-data');

// Training Data & Test Data
Route::get('/normalize-data', 'HomeController@normalizeData')->name('n-data');
Route::get('/training-data/normalize-data', 'HomeController@normalizeDataLatih')->name('n-data-latih');
Route::post('/analis-data', 'HomeController@analisData')->name('n-data-analis');
Route::post('/analis-data/{no_data}', 'HomeController@analisDataOne')->name('n-data-analis.one');
Route::get('/analis-data/test/{no_data}', 'HomeController@analisDataOne')->name('n-data-analis.one');
Route::get('/evalution-data', 'HomeController@evalData')->name('e-data');
Route::get('/training-data/evalution-data', 'HomeController@evalDataLatih')->name('e-data-latih');
// Import
Route::post('/data-import', 'HomeController@importData')->name('import');
// Export
Route::get('/data-export/{dt_type}', 'HomeController@exportData')->name('export');
// Download
Route::get('/download/train-data-template', 'HomeController@tdDownload')->name('td-download');
Route::get('/download/test-data-template', 'HomeController@testDtDownload')->name('test-dt-download');
//Hapus Semua Data
Route::get('/del-all-data-uji/{dt_type}', 'HomeController@destroyDtUji')->name('del-dtUji');
