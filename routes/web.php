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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function() {
	return "Hello word";
});

Route::post('/demo-post', function() {
	return "This is method post";
});

Route::put('/demo-put', function() {
	return "This is method put";
});

Route::get('/test', function() {
	return "This is test";
});

Route::redirect('/hello', '/test',301);

Route::get('/test-view', function() {
	return view('test_view');
});

Route::get('/sam-sung/{id}', function($idPd){
	return "samg sung - {$idPd}";
})->where('id','\d+');

Route::get('i-phone/{name?}', function($name = null) {
	return "This is Iphone - {$name}";
})->where('name','[A-Za-z]+');

Route::get('/sony/{id}/{name?}', function($idPd, $name=null){
	return "sony - {$idPd} : name - {$name}";
})->where(['id'=>'[A-Za-z]+', 'name' => '[A-Za-z]+']);

//Encoded Forward Slashes 
Route::get('/search/{id}/{name}/{keyword}', function($id, $name, $key) {
	return "ban vua tim kiem : {$key}";
})->where('keyword','.*');
//http://localhost:8000/search/1/a/<script>alert('A')</script>

Route::get('name-route-demo-123', function() {
	return "test name routing";
})->name('myNameRoute');

Route::get('watch-flim', function() {
	$url = route('myNameRoute');
	return $url;
	//return redirect()->route('myNameRoute');
	//return redirect('name-route-demo-123');
	// redirect : header('Location:url')
});

// group routing
// http://localhost:800/admin/home
// http://localhost:800/admin/user
// http://localhost:800/admin/product
Route::group([
	'prefix' => 'admin',
	'as' => 'admin.'
],function(){
	Route::get('/home', function() {
		return "Admin - home";
	})->name('home');
	Route::get('/user', function() {
		return "Admin - user";
	})->name('user');
});

Route::get('/home', function(){
	return "Home";
})->name('home');

Route::get('/my-login', function(){
	// truy cap vao dc home admin
	return redirect()->route('admin.home');
});

//Fallback Routes
// cho phep custom 404 mac dinh cua laravel
Route::fallback(function(){
	return 'not found page - 404';
});
// magic method : __call($r,$q)


Route::get('flim/{age}', function($age) {
	// dung middleware
	// next request
	return redirect()->route('flim-1');
})->middleware('check.age:user');
// :admin (admin la gia tri) tham so truyen vao middleware

Route::get('watch-all-flim', function() {
	return "chuc ban xem vui ve";
})->name('flim-1');

Route::get('watch-all-flim-v2', function() {
	return "chua du tuoi de xem";
})->name('flim-2');

Route::get('/check-number/{number}', function($number){
	return " This number - {$number}";
});

Route::get('/not-a-number', function() {
	return "khong phai la so chan";
})->name('nan');

/******* working with controller **********/
Route::get('demo-controller','DemoController@index')->name('index');
Route::get('test-controller','DemoController@test')->name('test');
/*
Route::get('exp','Example\TestController@index')->name('test.index');
Route::get('exp-2','Example\ExpController@index')->name('exp.index');
*/
Route::group([
	'namespace' => 'Example',
	//'middleware' => 'check.login'
], function(){
	Route::get('exp/{user}','TestController@demoData')->name('test.index');
	Route::get('exp-2','ExpController@index')->name('exp.index');
	Route::get('exp-3/{id}/{age}/{money}/{address?}','ExpController@demo')->name('exp.demo');

	Route::get('/user/login', 'ExpController@login')->name('user.login');
	Route::post('/handle-login','ExpController@handleLogin')->name('user.login');
});





