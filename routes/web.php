<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->group( function() {
	Route::get('/profile/{username}', 'ProfileController@index')->name('profile.page');
	Route::get('/profile/{username}/edit', 'ProfileController@edit'); /** show the edit form */
	Route::patch('/profile/{username}/edit', 'ProfileController@update'); /** actually do the edit action job */

	Route::get('/', 'PostsController@index');
	Route::get('/p/create', 'PostsController@create');
	Route::post('/p', 'PostsController@store');
	Route::get('/p/{post}', 'PostsController@show');
	Route::delete('/p/{post}', 'PostsController@destroy')->name('post.destroy');

	Route::post('/follow/{user}', 'FollowsController@store');
});

Route::get('/search', 'SearchController@search')->name('search'); /** search profile */
