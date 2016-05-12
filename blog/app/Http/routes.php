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

/************** Auth  ************************/
// Login Routes 
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



Route::get('/profile', array('before' => 'auth', function()
{
    // Only authenticated users may enter...
}));

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/posts/', 'posts@index');
Route::get('/posts/new', 'posts@create');
Route::post('/posts/create', 'posts@insert');

Route::get('/posts/{id}', 'posts@show');
Route::get('/posts/delete/{id}', 'posts@delete');

Route::get('/posts/edit/{id}', 'posts@update_form');
Route::post('/posts/update', 'posts@update');


Route::get('/comments/{id}', 'commentsController@delete');
Route::post('/comments/create', 'commentsController@insert');

