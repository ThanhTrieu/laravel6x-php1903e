<?php

/*************** For Frontend user *****************/
Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'namespace' => 'Frontend',
	'as' => 'fr.',
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function(){
	Route::get('/','HomeController@index')->name('home');
	Route::get('{slug}', 'DetailBlogController@index')->name('detailBlog');
	Route::post('/update-count-view','DetailBlogController@updateCountView')->name('updateCountView');
	Route::get('/category/{slug}~{id}', 'CategoryController@listCate')->name('categories');

	Route::get('/search/key','SearchController@index')->name('searchBlog');
	Route::get('/search/ajax','SearchController@ajaxSearch')->name('ajaxSearch');
});