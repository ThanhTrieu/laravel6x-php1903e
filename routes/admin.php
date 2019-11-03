<?php

// group routing
/******************** For Admin *************/
Route::group([
	'prefix' => LaravelLocalization::setLocale() . '/admin',
	'as' => 'admin.',
	'namespace' => 'Admin',
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function(){
	Route::get('/login', 'LoginController@index')->name('login');
	Route::post('/admin-login', 'LoginController@handleLogin')->name('handleLogin');
	Route::post('/admin-logout','LoginController@logout')->name('hanleLogout');
});

Route::group([
	'prefix' => LaravelLocalization::setLocale() . '/admin',
	'as' => 'admin.',
	'namespace' => 'Admin',
	'middleware' => ['web', 'check.admin.login','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function(){
	Route::get('/dashboard','DashboardController@index')->name('dashboard');

	Route::get('/posts','PostsController@index')->name('posts');
	Route::get('/create-post', 'PostsController@createPost')->name('createPost');
	Route::post('handle-create-post', 'PostsController@handleCreatePost')->name('handlCreatePost');
	Route::post('delete-post', 'PostsController@deletePost')->name('deletePost');
	Route::get('{slug}~{id}', 'PostsController@edit')->name('editPost');
	Route::post('update-post/{id}', 'PostsController@hanleUpdate')->name('handleUpdatePost');

	Route::get('/categories','CategoriesController@index')->name('category');

	Route::get('/tags','TagsController@index')->name('tag');

	Route::get('/users','UsersController@index')->name('user');
});

/************** end admin ***************/