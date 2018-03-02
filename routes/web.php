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

use Illuminate\Support\Facades\App;

Auth::routes();

Route::get( '/', 'HomeController@index' );

Route::resource( 'children', 'ChildrenController', [
	'except' => [
		'index',
		'create'
	]
] );

Route::resource( 'vacation', 'VacationController', [
	'except' => [
		'index',
		'create'
	]
] );
