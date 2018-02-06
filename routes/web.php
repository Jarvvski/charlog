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

// Authentication Routes
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

//////////
// STOP //
//////////

// TODO: This can't be allowed as an implimentation until permission system is in

// Registration Routes
// Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('admin/register', 'Auth\RegisterController@register');

// Password Reset Routes
// Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

//////////
// GO //
//////////

// General Routes
Route::get('/', 'CharacterController@index')->name('home');

Route::get('/characters', 'CharacterController@index')->name('character.index');
Route::get('/characters/{character}', 'CharacterController@show')->name('character.show');
Route::get('/character/search', 'CharacterController@search')->name('character.search');

Route::get('/records', 'RecordController@index')->name('record.index');
Route::get('/record/{record}', 'RecordController@show')->name('record.show');
Route::get('/test/something', 'RecordController@search')->name('record.search');

Route::get('/races', 'RaceController@index')->name('race.index');

// TODO: Finish race routes
// Route::get('/race/{race}', 'RaceController@show')->name('race.show');

// Admin Routes
Route::group(['middleware' => ['auth', 'web']], function () {

	// Character Routes
	Route::group(['as' => 'character.'], function () {
		Route::get('admin/character/create', 'CharacterController@create')->name('create');
		Route::get('admin/character/{character}/edit', 'CharacterController@edit')->name('edit');
		Route::post('admin/character/save', 'CharacterController@save')->name('save');
		Route::post('admin/character/{character}/update', 'CharacterController@update')->name('update');
		Route::delete('admin/character/{character}/delete', 'CharacterController@delete')->name('delete');
	});

	// Record Routes
	Route::group(['as' => 'record.'], function () {
		Route::get('admin/record/create', 'RecordController@create')->name('create');
		Route::get('admin/record/{record}/edit', 'RecordController@edit')->name('edit');
		Route::post('admin/record/save', 'RecordController@save')->name('save');
		Route::post('admin/record/{record}/update', 'RecordController@update')->name('update');
		Route::delete('admin/record/{record}/delete', 'RecordController@delete')->name('delete');
	});

	// Race Routes
	// Route::group(['as' => 'race.'], function() {
	// 	Route::get('admin/race/create', 'RaceController@create')->name('create');
	// 	Route::get('admin/race/{race}/edit', 'RaceController@edit')->name('edit');
	// 	Route::post('admin/race/save', 'RaceController@save')->name('save');
	// 	Route::post('admin/record/{race}/update', 'RaceController@update')->name('update');
	// 	Route::delete('admin/record/{race}/delete', 'RaceController@delete')->name('delete');
	// });
	
});