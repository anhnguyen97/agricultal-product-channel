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

		//update account
		Route::group(['prefix' => 'admin_profile'], function() {
			Route::get('', 'AdminController@getProfile')->name('admin.profile');
			Route::post('update/{admin_id}', 'AdminController@adminUpdateAccount')->name('admin.profile.update');
		});

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

//HOME
Route::get('', 'HomeController@index')->name('channel.index');
Route::get('home', 'HomeController@index')->name('channel.home');
Route::get('product_detail', 'HomeController@product_detail')->name('channel.product_detail');
Route::get('products', 'HomeController@getListProduct')->name('channel.getListProduct');
// Route::get('updateProduct', 'ProductController@updateDb');

//FARMER
Route::middleware('auth')->group(function(){

	Route::group(['prefix' => 'profile'], function() {
		Route::get('', 'UserController@getAccount')->name('user.profile');
		Route::post('update/{user_id}', 'UserController@userUpdateAccount')->name('user.profile.update');
	});

	Route::group(['prefix' => 'farmer'], function() {

		Route::group(['prefix' => 'product'], function() {
			Route::get('', 'ProductController@farmerProduct')->name('farmer.product');
			Route::get('getData', 'ProductController@farmerGetProduct')->name('farmer.product.getData');

			Route::post('store', 'ProductController@store')->name('farmer.product.store');
			Route::delete('delete/{id}', 'ProductController@destroy');
			Route::get('edit/{id}', 'ProductController@edit');
			Route::put('update/{id}', 'ProductController@update');
			Route::get('show_pro/{$id}', 'ProductController@show');
		});	

		Route::group(['prefix' => 'transaction'], function() {
			Route::get('', 'TransactionController@farmerIndex')->name('farmer.transaction');
			Route::get('getData', 'TransactionController@farmerGetTransaction')->name('farmer.transaction.getData');

			Route::get('{id}', 'TransactionController@farmerTranDetail');
			Route::get('detail/getData/{tran_id}', 'TransactionController@farmerGetTranDetail')->name('farmer.transDetail.getData');

			Route::delete('delete/{id}', 'TransactionController@farmerDestroy');			
		});
	});

	//TRADER
	Route::group(['prefix' => 'trader'], function() {

		Route::group(['prefix' => 'product'], function() {
			Route::get('', 'ProductController@traderProduct')->name('trader.product');
			Route::get('getData', 'ProductController@traderGetProduct')->name('trader.product.getData');

			Route::post('store', 'ProductController@store')->name('trader.product.store');
			Route::delete('delete/{id}', 'ProductController@destroy');
			Route::get('edit/{id}', 'ProductController@edit');
			Route::put('update/{id}', 'ProductController@update');
			Route::get('show_pro/{$id}', 'ProductController@show');
		});	

		Route::group(['prefix' => 'transaction'], function() {
			Route::get('import', 'TransactionController@traderImport')->name('trader.transaction.import');
			Route::get('import/getData', 'TransactionController@traderGetTranImport')->name('trader.transaction.getDataImport');

			Route::get('export', 'TransactionController@traderExport')->name('trader.transaction.export');
			Route::get('export/getData', 'TransactionController@traderGetTranExport')->name('trader.transaction.getDataExport');

			Route::get('import/{id}', 'TransactionController@traderTranImportDetail');
			Route::get('import_detail/getData/{tran_id}', 'TransactionController@traderGetTranImportDetail')->name('trader.transDetail.getData');

			Route::get('export/{id}', 'TransactionController@traderTranExportDetail');
			// Route::get('export_detail/getData/{tran_id}', 'TransactionController@traderGetTranImportDetail')->name('trader.transDetail.getData');

			Route::delete('delete/{id}', 'TransactionController@traderDestroy');			
		});
		
	});
	
});
