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
*/

//Route::get('/', 'EmployeController@index');


Route::get('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@index')->middleware('auth');
Route::post('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@store' )->middleware('auth');

Route::resource('employes', 'EmployeController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('users', 'UserController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('logs', 'LogsController')->only(['show', 'index'])->middleware('auth');
Route::resource('empone', 'EmpOneController')->only(['create', 'store'])->middleware('auth');
Route::resource('couples', 'CoupleController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('enfants', 'EnfantController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
//Route::get('/search', 'EmployeController@search')->name('search');

Route::get('/search','SearchController@search')->name('search')->middleware('auth');
Route::post('/search','SearchController@getSearch')->name('getSearch')->middleware('auth');

Route::get('/search2', 'SearchController@index')->name('search2');
Route::get('/autocomplete', 'SearchController@autocomplete')->name('autocomplete');

Route::resource('products', 'ProductController')->middleware('auth');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
