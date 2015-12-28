<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*Authentication and registration routes*/
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');

//Route::get('register', 'Auth\AuthController@getRegister');
//Route::post('register', 'Auth\AuthController@postRegister');
/*===================================================*/

Route::get('/', function () {
    return view('backend.index');
});
Route::get('customers', 'CustomerController@index');
Route::get('customers/new', 'CustomerController@newCustomer');
Route::post('customers/create', 'CustomerController@storeCustomer');
Route::any('customers/remove/{id}', 'CustomerController@removeCustomer');
Route::get('customers/edit/{id}', 'CustomerController@editCustomer');
Route::post('customers/update', 'CustomerController@updateCustomer');

Route::get('products', 'ProductController@index');
Route::get('products/new', 'ProductController@newProduct');
Route::post('products/create', 'ProductController@storeProduct');
Route::any('products/remove/{id}', 'ProductController@removeProduct');
Route::get('products/edit/{id}', 'ProductController@editProduct');
Route::post('products/update', 'ProductController@updateProduct');

Route::get('users', 'UserController@index');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
