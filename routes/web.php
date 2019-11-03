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

Route::group([
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function(){
	Auth::routes();
	Route::get('/home', 'HomeController@index')->name('home');
});

/**************** web service ***********************/
require_once 'service.php';

/*********** Route for Frontend  **********************/
require_once 'frontend.php';


/************ switch language **********************/
Route::get('switch-language/{lang?}', function($lang = 'en'){
	// set ngon ngu cho ung dung
	App::setLocale($lang);

	// gan vao session
	Session::put('lang', $lang);

	// set lai ngon ngu bang thu vien LaravelLocalization
	LaravelLocalization::setLocale($lang);

	// dieu huong quay ve dung trang ma nguoi dung dang o truoc khi bam link chuyen ngon ngu
	// App::getLocale() : lay ra language dang duoc xet
	// \URL::previous() : quay ve lai dung trang truoc do
	$url = LaravelLocalization::getLocalizedURL(App::getLocale(), \URL::previous());

	// quay ve trang truoc do
	return Redirect::to($url);
})->name('switchLanguage');

/*********** Route for Admin  **********************/
require_once 'admin.php';

