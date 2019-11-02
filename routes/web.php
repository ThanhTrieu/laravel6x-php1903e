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

/*************** For Frontend user *****************/
Route::group([
	'namespace' => 'Frontend',
	'as' => 'fr.'
],function(){
	Route::get('/','HomeController@index')->name('home');
	Route::get('{slug}', 'DetailBlogController@index')->name('detailBlog');
	Route::post('/update-count-view','DetailBlogController@updateCountView')->name('updateCountView');
	Route::get('/category/{slug}~{id}', 'CategoryController@listCate')->name('categories');

	Route::get('/search/key','SearchController@index')->name('searchBlog');
	Route::get('/search/ajax','SearchController@ajaxSearch')->name('ajaxSearch');
});



// group routing
/******************** For Admin *************/
Route::group([
	'prefix' => 'admin',
	'as' => 'admin.',
	'namespace' => 'Admin'
],function(){
	Route::get('/login', 'LoginController@index')->name('login');
	Route::post('/admin-login', 'LoginController@handleLogin')->name('handleLogin');
	Route::post('/admin-logout','LoginController@logout')->name('hanleLogout');
});

Route::group([
	'prefix' => 'admin',
	'as' => 'admin.',
	'namespace' => 'Admin',
	'middleware' => ['web', 'check.admin.login']
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





