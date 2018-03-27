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
	'except' => [
		'index',
		'create'
	]
] );

Route::resource( 'vaccination', 'VaccinationController', [
	'except' => [
		'index',
		'create'
	]
] );

Auth::routes();

Route::get( '/home', 'HomeController@index' );
