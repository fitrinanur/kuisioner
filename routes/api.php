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
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResources(['user' => 'API\UserController']);
Route::get('/edit-user/{id}','API\UserController@edit');
Route::get('/profile','API\UserController@profile')->name('profile');
Route::put('/profile','API\UserController@updateProfile');

Route::apiResources(['question-indicators' => 'API\QuestionIndicatorController']);
Route::get('/edit-question-indicators/{id}','API\QuestionIndicatorController@edit');

Route::apiResources(['questions' => 'API\QuestionController']);
Route::get('/create-indicator','API\QuestionController@create');
Route::get('/edit-question/{id}','API\QuestionController@edit');

Route::apiResources(['options' => 'API\OptionController']);
Route::get('/create-option','API\OptionController@create');
Route::get('/edit-option/{id}','API\OptionController@edit');


Route::apiResources(['suggestions' => 'API\SuggestionController']);
Route::get('/suggestion-create','API\SuggestionController@create');
Route::get('/edit-suggestion/{id}','API\SuggestionController@edit');

Route::apiResources(['option-suggestion' => 'API\OptionSuggestionController']);
Route::get('/create-option-suggestion','API\OptionSuggestionController@create');
Route::get('/edit-result/{id}','API\OptionSuggestionController@edit');

Route::apiResources(['event' => 'API\PostController']);
Route::get('/edit-event/{id}','API\PostController@edit');


Route::apiResources(['icon' => 'API\IconController']);
Route::get('/edit-icon/{id}','API\IconController@edit');


Route::get('/subscriber','API\SubscriberController@index');
Route::delete('/subscriber/{id}','API\SubscriberController@destroy');

Route::get('/dashboard-data','API\SettingController@dashboardData');
Route::get('/setting-update','API\SettingController@setting');
Route::patch('/setting','API\SettingController@update');
