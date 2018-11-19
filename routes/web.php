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
Route::group(['prefix' => 'admin'], function() {

	// Authentication Routes...
	Route::get('', 'AdminAuth\LoginController@showLoginForm');
	Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'AdminAuth\LoginController@login')->name('admin.login.process');
	Route::post('logout', 'AdminAuth\LoginController@logout')->name('admin.logout');

    // Password Reset Routes...
	Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset')->name('admin.password.update');	

	Route::middleware('admin.auth')->group(function(){

		Route::get('', 'ManagePageController@index')->name('admin.home');
		Route::get('home', 'ManagePageController@index');

		Route::group(['prefix' => 'admin-account'], function() {

			Route::get('', 'AdminController@index')->name('admin.admin');

			Route::get('/getData', 'AdminController@getData')->name('admin.admin.getData');

			Route::post('/store', 'AdminController@store')->name('admin.admin.store');

			Route::get('/edit/{id}', 'AdminController@edit');

			Route::put('/update/{id}', 'AdminController@update');

			Route::delete('/delete/{id}', 'AdminController@destroy');

		});


		Route::group(['prefix' => 'user-account'], function() {

			Route::get('', 'UserController@index')->name('admin.user');

			Route::get('/getData', 'UserController@getData')->name('admin.user.getData');

			Route::post('/store', 'UserController@store')->name('admin.user.store');

			Route::get('/edit/{id}', 'UserController@edit');

			Route::put('/update/{id}', 'UserController@update');

			Route::delete('/delete/{id}', 'UserController@destroy');

		});

		Route::group(['prefix' => 'category'], function() {

			Route::get('', 'CategoryController@index')->name('admin.category');

			Route::get('/getData', 'CategoryController@getData')->name('admin.category.getData');

			Route::post('/store', 'CategoryController@store')->name('admin.category.store');

			Route::get('/edit/{id}', 'CategoryController@edit');

			Route::put('/update/{id}', 'CategoryController@update');

			Route::delete('/delete/{id}', 'CategoryController@destroy');

		});
	});

});

Auth::routes();

// Route::get('/home', 'AdminController@index')->name('home');

Route::get('', function() {
    return view('channel.index');
});
