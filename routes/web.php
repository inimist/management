<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@home');

Route::get('testtt', function() {
	return 'test OK ' . config('app.debug') . ' end';
});

Route::get('login', 'LoginController@login');
Route::post('login', 'LoginController@handleLogin');



Route::resource('/accounts', 'AccountsController');


Route::post('/accounts/approve', ['uses' => 'AccountsController@approve', 'as' => 'accounts.approve']);
//Route::get('/accounts/claim', ['uses' => 'AccountsController@claim', 'as' => 'accounts.claim']);

Route::get('/accounts/{id}/posts', ['uses' => 'AccountsController@posts', 'as' => 'accounts.posts']);
Route::get('/accounts/{id}/claim', ['uses' => 'AccountsController@claim', 'as' => 'accounts.claim']);

Route::get('/accounts/{id}/viewclaim', ['uses' => 'AccountsController@viewclaim', 'as' => 'accounts.viewclaim']);

Route::match(['post', 'get'], '/accounts/{id}/photo', ['uses' => 'AccountsController@photo', 'as' => 'accounts.photo']);
Route::get('/accounts/{id}/homefeed', ['uses' => 'AccountsController@homeFeed', 'as' => 'accounts.homefeed']);
Route::get('/accounts/{id}/following', ['uses' => 'AccountsController@following', 'as' => 'accounts.following']);
Route::get('/accounts/{id}/followers', ['uses' => 'AccountsController@followers', 'as' => 'accounts.followers']);
Route::post('/accounts/{id}/addbadge', ['uses' => 'AccountsController@addBadge', 'as' => 'accounts.addBadge']);
Route::post('/accounts/{id}/removebadge', ['uses' => 'AccountsController@removeBadge', 'as' => 'accounts.removeBadge']);

Route::get('/places/{id}/posts', ['uses' => 'PlacesController@posts', 'as' => 'places.posts']);
Route::get('/places/{id}/addresses/{addressId}/create', 'PlaceAddressesController@create')->name('placeaddresses.create');
Route::post('/places/{id}/addresses', 'PlacesAddressesController@store')->name('placeaddresses.store');
Route::get('/places/{id}/addresses/{addressId}/edit', 'PlaceAddressesController@edit')->name('placeaddresses.edit');
Route::put('/places/{id}/addresses/{addressId}/edit', 'PlaceAddressesController@update')->name('placeaddresses.update');
Route::get('/places/{id}/addresses/{addressId}/delete', 'PlaceAddressesController@delete')->name('placeaddresses.delete');

Route::get('/categories/{categoryId}/filters', ['uses' => 'CategoriesController@filtersIndex', 'as' => 'categories.filtersIndex']);
Route::get('/categories/autocomplete', ['uses' => 'CategoriesController@autocomplete', 'as' => 'categories.autocomplete']);
Route::get('/categories/browse', ['uses' => 'CategoriesController@browse', 'as' => 'categories.browse']);
Route::get('/categories/{categoryId}/filters/{filterId}/add', ['uses' => 'CategoriesController@addFilter', 'as' => 'categories.addFilter']);
Route::get('/categories/{categoryId}/filters/{filterId}/remove', ['uses' => 'CategoriesController@removeFilter', 'as' => 'categories.removeFilter']);
Route::post('/categories/{categoryId}/filters/{filterId}/values', ['uses' => 'CategoriesController@setFilterValue', 'as' => 'categories.setFilterValue']);
Route::get('/categories/{categoryId}/posts', ['uses' => 'CategoriesController@posts', 'as' => 'categories.posts']);

Route::resource('/places', 'PlacesController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/filters', 'FiltersController');

Route::resource('/posts', 'PostsController');
//Route::get('/posts/{postId}/flags', ['uses' => 'PostsController@flagsIndex', 'as' => 'posts.flags']);
Route::get('/posts/{postId}/flags/approveflag/{flagId}', ['uses' => 'PostsController@approveFlag', 'as' => 'posts.approveFlag']);
Route::get('/posts/{postId}/flags/disapproveflag/{flagId}', ['uses' => 'PostsController@disapproveFlag', 'as' => 'posts.disapproveFlag']);

Route::get('/flags', ['uses' => 'FlagsController@index', 'as' => 'flags.index']);
