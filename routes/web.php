<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|



 Route::get('/welcome', function () {
     return view('welcome');
 });
 Route::get('/dashboard', Dashboard::class)->name('dashboard');
*/

Route::get('/download/{file}', 'DownloadsController@download');
Route::get('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@index')->middleware('auth');
Route::post('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@store' )->middleware('auth');

Route::resource('employes', 'EmployeController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('users', 'UserController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('logs', 'LogsController')->only(['show', 'index'])->middleware('auth');

Route::resource('empone', 'EmpOneController')->only(['create', 'store'])->middleware('auth');
Route::resource('beneficier', 'BeneficierController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');





Route::resource('couples', 'CoupleController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('enfants', 'EnfantController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
//Route::get('/search', 'EmployeController@search')->name('search');
Route::resource('couplesB', 'CouplebController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('enfantsB', 'EnfantbController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
//Route::get('/search', 'EmployeController@search')->name('search');

Route::get('/search','SearchController@search')->name('search')->middleware('auth');
Route::post('/search','SearchController@getSearch')->name('getSearch')->middleware('auth');

Route::get('/search2', 'SearchController@index')->name('search2');
Route::get('/autocomplete', 'SearchController@autocomplete')->name('autocomplete');



Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');



Route::get('/employes-import-form', '\App\Http\Controllers\EmployeImportController@importFrom')->name('employes-import-form')->middleware('auth');;
Route::post('employes-import', '\App\Http\Controllers\EmployeImportController@import')->name('employes-import')->middleware('auth');



Route::get('beneficiers-export', 'BeneficierExportController@export');
Route::get('/beneficiers-import-form', '\App\Http\Controllers\BeneficierImportController@importFrom')->name('beneficiers-import-form')->middleware('auth');;
Route::post('beneficiers-import', '\App\Http\Controllers\BeneficierImportController@import')->name('beneficiers-import')->middleware('auth');

Route::get('/couples-import-form', 'CoupleImportController@importFrom')->name('couples-import-form')->middleware('auth');
Route::post('/couples-import', 'CoupleImportController@import')->name('couples-import')->middleware('auth');

Route::get('/couplesb-import-form', 'CouplebImportController@importFrom')->name('couplesb-import-form')->middleware('auth');
Route::post('/couplesb-import', 'CouplebImportController@import')->name('couplesb-import')->middleware('auth');

Route::get('/enfants-import-form', 'EnfantImportController@importFrom')->name('enfants-import-form')->middleware('auth');
Route::post('/enfants-import', 'EnfantImportController@import')->name('enfants-import')->middleware('auth');

Route::get('/enfantsb-import-form', 'EnfantbImportController@importFrom')->name('enfantsb-import-form')->middleware('auth');
Route::post('/enfantsb-import', 'EnfantbImportController@import')->name('enfantsb-import')->middleware('auth');


Route::get('form-import','\App\Http\Controllers\UsersImportController@show')->middleware('auth');
Route::post('handle-import','\App\Http\Controllers\UsersImportController@store')->middleware('auth');


Route::post('users-export', 'ExcelController@users')->name('users-export')->middleware('auth');
Route::post('beneficiers-export', 'ExcelController@beneficiers')->name('beneficiers-export')->middleware('auth');
Route::post('employes-export', 'ExcelController@employes')->name('employes-export')->middleware('auth');
Route::post('enfants-export', 'ExcelController@enfants')->name('enfants-export')->middleware('auth');
Route::post('enfantsb-export', 'ExcelController@enfantsb')->name('enfantsb-export')->middleware('auth');
Route::post('conjoints-export', 'ExcelController@conjoints')->name('conjoints-export')->middleware('auth');
Route::post('conjointsb-export', 'ExcelController@conjointsb')->name('conjointsb-export')->middleware('auth');

