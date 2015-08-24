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

Route::get('/logout', function () {
	Auth::logout();

	return redirect('/');
});

Route::get('/login', ['as' => 'loginGet', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'loginPost', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('categories/{id}', ['as' => 'products','uses'=>'Frontend\Products@index']);
Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Categories@index']);
Route::get('categories', ['as' => 'categories', 'uses' => 'Frontend\Categories@index']);
Route::get('shoppingcart', ['as' => 'shoppingcart', 'uses' => 'Frontend\ShoppingCart@shoppingcart']);
Route::get('checkout', ['as' => 'checkout', 'uses' => 'Frontend\Orders@checkOut']);
Route::get('register', ['as' => 'registerGet', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', 'Auth\AuthController@postRegister');

Route::post('submit', 'Frontend\Orders@submit');
Route::get('/thankyou',['as' => 'thankyou', function () {
	return View('customerPages.thankyou');
}]);


//Ajax calls
Route::get('ajax/products/{id}','Frontend\Products@ajax');
Route::get('ajax/shoppingcart/{id}','Frontend\ShoppingCart@addToShoppingcart');
Route::get('ajax/removeitem/{id}', 'Frontend\ShoppingCarts@removeItem');

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
	});
});

