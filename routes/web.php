<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GeneticMarkerController;
use App\Http\Controllers\GeneticProfileController;
use App\Http\Controllers\GeneticMarkerYController;




Route::get('genetic-profiles/search', [GeneticProfileController::class, 'search'])->name('genetic_profiles.search');

Route::get('genetic-profiles/create', [GeneticProfileController::class, 'create'])->name('genetic-profiles.create');
Route::post('genetic-profiles/store', [GeneticProfileController::class, 'store'])->name('genetic-profiles.store');
Route::get('/genetic-profiles/{id}', [GeneticProfileController::class, 'show'])->name('genetic-profiles.show');





Route::get('/genetic-profiles', [GeneticProfileController::class, 'index'])->name('genetic-profiles.index');
Route::get('genetic-markers/create', [GeneticMarkerController::class, 'create'])->name('genetic-markers.create');
Route::post('genetic-markers/store', [GeneticMarkerController::class, 'store'])->name('genetic-markers.store');
Route::get('/genetic-markers/search', [GeneticMarkerController::class, 'search'])->name('genetic_markers.search');
Route::get('genetic-markers/{id}', [GeneticMarkerController::class, 'show'])->name('genetic-markers.show');

Route::get('/search-genetic-markers', [GeneticMarkerYController::class, 'search'])->name('genetic-markers-y.search');




Route::get('/y-markers/create', [GeneticMarkerYController::class, 'create'])->name('y-markers.create');


Route::post('/y-markers/store', [GeneticMarkerYController::class, 'store'])->name('genetic-markers-y.store');


Route::get('/y-markers/show/{id}', [GeneticMarkerYController::class, 'show'])->name('genetic-markers-y.show');



Route::get('/download/{file}', 'DownloadsController@download');
Route::get('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@index')->middleware('auth');
Route::post('add-remove-multiple-input-fields', 'DynamicAddRemoveFieldController@store' )->middleware('auth');

Route::resource('employes', 'AffaireController')->only(['create', 'store','index', 'destroy', 'update','edit', 'show'])->middleware('auth');

Route::resource('users', 'UserController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search', 'search2'])->middleware('auth');
Route::resource('logs', 'LogsController')->only(['show', 'index'])->middleware('auth');

Route::resource('empone', 'EmpOneController')->only(['create', 'store'])->middleware('auth');
Route::resource('beneficier', 'BeneficierController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');


Route::resource('echantillons', 'EchantillonController')->only(['create', 'store', 'index','edit','update'])->middleware('auth');

Route::resource('intervenants', 'IntervenantController')->only(['create', 'store', 'index','show','destroy'])->middleware('auth');


Route::resource('rapports', 'RapportController')->only(['create', 'store', 'edit', 'update', 'index'])->middleware('auth');
Route::resource('reste_scelle', 'ReserveController')->only(['index', 'store','create'])->middleware('auth');

Route::resource('commissariats', 'CommiseriatController')->only(['create', 'store','index', 'show'])->middleware('auth');

Route::resource('couples', 'CoupleController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('enfants', 'EnfantController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');

Route::resource('couplesB', 'CouplebController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');
Route::resource('enfantsB', 'EnfantbController')->only(['create', 'show', 'edit', 'update', 'store', 'index', 'destroy', 'search'])->middleware('auth');

Route::resource('genetic-profiles', 'GeneticProfileController')->only(['create', 'store', 'search'])->middleware('auth');

Route::get('/search','SearchController@search')->name('search')->middleware('auth');
Route::post('/search','SearchController@getSearch')->name('getSearch')->middleware('auth');

Route::get('/search2', 'SearchController@index')->name('search2');
Route::get('/autocomplete', 'SearchController@autocomplete')->name('autocomplete');



Auth::routes(['verify'=>true]);

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

Route::get('users.editt', 'UserEditController@editt')->name('users.editt')->middleware('auth');
Route::post('users.updatee', 'UserEditController@updatee')->name('users.updatee')->middleware('auth');

Route::post('users-export', 'ExcelController@users')->name('users-export')->middleware('auth');
Route::post('beneficiers-export', 'ExcelController@beneficiers')->name('beneficiers-export')->middleware('auth');
Route::post('employes-export', 'ExcelController@employes')->name('employes-export')->middleware('auth');
Route::post('enfants-export', 'ExcelController@enfants')->name('enfants-export')->middleware('auth');
Route::post('enfantsb-export', 'ExcelController@enfantsb')->name('enfantsb-export')->middleware('auth');
Route::post('conjoints-export', 'ExcelController@conjoints')->name('conjoints-export')->middleware('auth');
Route::post('conjointsb-export', 'ExcelController@conjointsb')->name('conjointsb-export')->middleware('auth');

