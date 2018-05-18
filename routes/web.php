<?php

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


use Illuminate\Support\Facades\Redirect;

Auth::routes();

Route::get( '/', 'HomeController@index' );
Route::get( '/vaccination/{childId}', 'HomeController@vaccination' )->where( 'childId', '[0-9]+' );
Route::get( '/bmi/{childId}', 'HomeController@bmi' )->where( 'childId', '[0-9]+' );

Route::get( 'lang/{lang}', [ 'as' => 'lang.switch', 'uses' => 'LanguageController@switchLang' ] );

Route::resource( 'children', 'ChildrenController', [
	'only' => [
		'store',
		'childrenVacc'
	]
] );

Route::post( 'childrenVacc', 'ChildrenController@childrenVacc' );
Route::post( 'getVaccinationForm', 'AjaxController@getVaccinationForm' );

Route::resource( 'admin', 'AdminController', [
	'only' => [
		'index',
		'show'
	]
] );
Route::resource( 'vacc', 'VaccinationController', [
	'only' => [
		'store',
		'update',
		'destroy'
	]
] );

Route::resource( 'bmi', 'BmiController', [
	'only' => [
		'store',
		'update',
		'destroy'
	]
] );
Route::get( 'new_surgery', 'Surgery\SurgeryController@newSurgery' );
Route::post( 'verify_surgery/{id}', 'Surgery\SurgeryController@verify' );
Route::get( '/surgery/search', 'Surgery\SurgeryController@search' );
Route::resource( 'surgery', 'Surgery\SurgeryController', [
	'except' => [
		'index'
	]
] );


Route::post( 'defaultBmiUpload', 'Admin\BmiController@storeBmiFile' )->name( 'defaultBmi.upload' );
Route::post( 'defaultBmiStore/{fileId}', 'Admin\BmiController@storeBmi' )->name( 'defaultBmi.store' )->where( 'fileId', '[0-9]+' );
Route::resource( 'defaultBmi', 'Admin\BmiController', [
	'only' => [
		'destroy',
	]
] );

Auth::routes();

Route::get( '/home', 'HomeController@index' );

