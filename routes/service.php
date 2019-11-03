<?php
Route::group([
	'namespace' => 'Service',
	'as' => 'service.'
],function(){
	Route::get('create-token', 'CreateTokenController@index')->name('createToken');
	Route::get('decode-token/{token}','CreateTokenController@decodeToken')->name('decodeToken');
});