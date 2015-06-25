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

Route::get('/', function () {
    return view('welcome');
});

//Frontend routes
Route::get('/about', function () {
    return View('customerPages.about');
});
Route::get('/policy', function () {
	return View('customerPages.policy');
});
Route::get('/contact', function () {
	return View('customerPages.contact');
});

Route::get('categories/{id}', ['uses'=>'Frontend\Products@index']);
Route::resource('products/categories', 'Frontend\Products');
Route::resource('navigation', 'Frontend\Navigation');
Route::resource('categories', 'Frontend\Categories');



//CMS routes
Route::group(['namespace' => 'Cms', 'prefix' => 'beheer'], function (){
	Route::get('login', ['uses' => 'Login@index', 'as' => 'cmsLogin']);
	Route::post('login', ['uses' => 'Login@login', 'as' => 'cmsLogin']);

	Route::group(['middleware' => 'auth:login'], function () {
		
	});
});

