<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'root', 'uses' => 'Frontend\Categories@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'Frontend\Categories@index']);

//Frontend routes
Route::get('/about',['as' => 'about', function () {
    return View('customerPages.about');
}]);
Route::get('/policy',['as' => 'policy', function () {
	return View('customerPages.policy');
}]);
Route::get('/contact',['as' => 'contact', function () {
	return View('customerPages.contact');
}]);
Route::get('/mailtemp',['as' => 'mailtemp', function () {
	return View('mail.confirmation');
}]);



Route::get('/logout', function () {
	Auth::logout();

	return redirect('/');
});

//auth route
Route::get('/login', ['as' => 'loginGet', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'loginPost', 'uses' => 'Auth\AuthController@postLogin']);

//page routes
Route::get('categories/{id}', ['as' => 'products','uses'=>'Frontend\Products@index']);
Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Categories@index']);
Route::get('categories', ['as' => 'categories', 'uses' => 'Frontend\Categories@index']);
Route::get('shoppingcart', ['as' => 'shoppingcart', 'uses' => 'Frontend\ShoppingCart@shoppingcart']);
Route::get('register', ['as' => 'registerGet', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

//order processing
Route::get('checkout', ['as' => 'checkoutPage', 'uses' => 'Frontend\Orders@checkOut']);
Route::post('postCheckout',['as' => 'postCheckout', 'uses' => 'Frontend\Orders@submit']);
Route::get('thankyou',['as' => 'thankyou', function () {
	return View('customerPages.thankyou');
}]);

Route::get('resultspage', ['as' => 'resultsPage', 'uses' => 'Frontend\Products@displayResults']);

//mailer
Route::get('sendmail',['as' => 'sendmail', 'uses' => 'Frontend\Orders@sendMail']);

//Ajax calls
Route::get('ajax/products/{id}','Frontend\Products@ajax');
Route::get('ajax/searchproduct/{value}', 'Frontend\Products@searchProduct');
Route::get('ajax/shoppingcart/{id}','Frontend\ShoppingCart@addToShoppingcart');
Route::get('ajax/shoppingcartonly/','Frontend\ShoppingCart@shoppingCartOnly');
Route::get('ajax/removeitem/{id}', 'Frontend\ShoppingCart@removeItem');
Route::get('ajax/updateitem-quantity/{id}/{quantity}', 'Frontend\ShoppingCart@updateItemQuantity');

//CMS routes
Route::group(['namespace' => 'Cms', 'prefix' => 'beheer'], function (){
	Route::get('/', ['uses' => 'Login@index', 'as' => 'cmsLoginGet']);
	Route::get('login', ['uses' => 'Login@index', 'as' => 'cmsLoginGet']);
	Route::post('login', ['uses' => 'Login@login', 'as' => 'cmsLoginPost']);

	Route::group(['middleware' => 'role:superadmin|cmsadmin,home'], function () {
		Route::resource('dashboard', 'Dashboard');
		Route::resource('orders', 'Orders');
		Route::resource('products', 'Products');
		Route::resource('categories', 'Categories');
		Route::resource('navigation', 'Navigation');
		Route::resource('users', 'Users');
		Route::get('import', ['uses' => 'Import@getUploadZip', 'as' => 'getUploadZip']);
		Route::get('import/uploadzip', ['uses' => 'Import@getUploadZip', 'as' => 'getUploadZip']);
		Route::post('import/uploadzip', ['uses' => 'Import@postUploadZip', 'as' => 'postUploadZip']);
		Route::get('import/uploadexcel', ['uses' => 'Import@getUploadExcel', 'as' => 'getUploadExcel']);
		Route::post('import/uploadexcel', ['uses' => 'Import@postUploadExcel', 'as' => 'postUploadExcel']);
	});
});

