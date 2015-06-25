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

Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Categories@index']);

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

Route::get('categories/{id}', ['as' => 'categories/','uses'=>'Frontend\Products@index']);
Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Categories@index']);
Route::get('categories', ['as' => 'categories', 'uses' => 'Frontend\Categories@index']);



//CMS routes
Route::group(['namespace' => 'Cms', 'prefix' => 'beheer', 'as' => 'Cms::'], function (){
	Route::get('login', ['uses' => 'Login@index', 'as' => 'cmsLoginGet']);
	Route::post('login', ['uses' => 'Login@login', 'as' => 'cmsLoginPost']);

	Route::group(['middleware' => 'role:superadmin|cmsadmin,home'], function () {
		Route::resource('dashboard', 'Dashboard');
	});
});

