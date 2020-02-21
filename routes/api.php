<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| 
| This is implemented by client_credentials token type 
*/

Route::get('/p', 'Api\PostsController@index');
Route::get('/p/{id}', 'Api\PostsController@show');
Route::post('/p/create', 'Api\PostsController@store');
Route::put('p/edit/{id}', 'Api\PostsController@update');
Route::delete('/p/delete/{id}', 'Api\PostsController@destroy');

// Route::get('/profile/{user}', 'api/ProfileController@index');
// Route::get('/profile/{user}/edit', 'api/ProfileController@edit'); /** show the edit form */
// Route::patch('/profile/{username}', 'api/ProfileController@update'); /** actually do the edit action job */