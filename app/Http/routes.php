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
    Route::resource('user', 'User\UsersController', [
         'only' => ['index', 'show', 'edit', 'update']
     ]);

    Route::resource('category', 'User\CategoryController', [
         'only' => ['index']
     ]);

    Route::resource('word_list', 'User\WordController', [
         'only' => ['index']
     ]);

    Route::resource('relationship', 'User\RelationshipsController', [
         'only' => ['create', 'destroy']
     ]);

    Route::resource('lesson', 'User\LessonController', [
         'only' => ['index']
     ]);

    Route::resource('result', 'User\ResultController', [
         'only' => ['store']
     ]);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function()
{
    Route::resource('category', 'Admin\CategoryController');
    Route::resource('word', 'Admin\WordController');
    Route::resource('user', 'Admin\UserController');
    Route::resource('answer', 'Admin\AnswerController');
    Route::resource('lesson', 'Admin\LessonController');
});

Route::get('/redirect/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/callback/{provider}', 'SocialAuthController@handleProviderCallback');

Route::post('/filter-word', 'User\FilterController@filterWord');

Route::auth();

Route::get('/home', 'HomeController@index');
