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


Route::get('/about', function () {
    return View('customerPages.about');
});
Route::get('/policy', function () {
	return View('customerPages.policy');
});
Route::get('/contact', function () {
	return View('customerPages.contact');
});


//CMS routes
Route::group(['namespace' => 'Cms', 'prefix' => 'beheer'], function (){
	Route::resource('login', 'Login', [
		'only' => [
			'index', 
			'post'
		],
        'names' => [
        	'create' => 'login.post'
        ]
    ]);

	Route::group(['middleware' => 'auth:login'], function () {

	});
});

