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

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function()
{
    Route::resource('user', 'User\UserController', [
         'only' => ['edit', 'update']
     ]);

    Route::resource('category', 'User\CategoryController', [
         'only' => ['index']
     ]);

    Route::resource('word_list', 'User\WordController', [
         'only' => ['index']
     ]);
});

Route::auth();

Route::get('/home', 'HomeController@index');
