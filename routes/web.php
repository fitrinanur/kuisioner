<?php
use App\IconSymbol;

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
	$icons = IconSymbol::all();
    return view('welcome',compact('icons'));
});

Route::get('/theme-setting/{val}', 'SettingControlle@update_theme')->name('theme-setting');
Route::get('quiz/{id}', 'QuestionController@index')->name('quiz');
Route::get('suggestion/{data}', 'QuestionController@getPageDatte')->name('suggestion');
Route::post('get-result', 'QuestionController@answer')->name('get-result');
// Route::get('fråga-ans', 'QuestionController@answer')->name('question-ans');
// Route::get('fråga-ans/data', 'QuestionController@answer')->name('question-ans');
Route::get('user-subscriber', 'SubscriberController@index')->name('subscriber');
Route::post('user-subscriber', 'SubscriberController@store')->name('store.subscriber');
Route::put('informed-consent', 'SubscriberController@informedConsent')->name('informed-consent');
Route::get('poster-vaccine', 'PosterController@index')->name('poster');
Route::get('video-vaccine', 'VideoController@index')->name('video');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/subscriber/pre/exports','SubscriberController@doExportPre')->middleware('auth');
Route::get('/subscriber/post/exports','SubscriberController@doExportPost')->middleware('auth');
Route::get('/{path}','HomeController@index')->where( 'path', '.*' );


