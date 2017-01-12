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

Route::get('/', 'HomeController@index');
Route::group(['middleware'=> 'web'],function(){
});

//member Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('member','\App\Http\Controllers\MemberController');
  Route::post('member/{id}/update','\App\Http\Controllers\MemberController@update');
  Route::get('member/{id}/delete','\App\Http\Controllers\MemberController@destroy');
  Route::get('member/{id}/deleteMsg','\App\Http\Controllers\MemberController@DeleteMsg');
});

//team Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('team','\App\Http\Controllers\TeamController');
  Route::post('team/{id}/update','\App\Http\Controllers\TeamController@update');
  Route::get('team/{id}/delete','\App\Http\Controllers\TeamController@destroy');
  Route::get('team/{id}/deleteMsg','\App\Http\Controllers\TeamController@DeleteMsg');
});

//position Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('position','\App\Http\Controllers\PositionController');
  Route::post('position/{id}/update','\App\Http\Controllers\PositionController@update');
  Route::get('position/{id}/delete','\App\Http\Controllers\PositionController@destroy');
  Route::get('position/{id}/deleteMsg','\App\Http\Controllers\PositionController@DeleteMsg');
});

//article Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('article','\App\Http\Controllers\ArticleController');
  Route::post('article/{id}/update','\App\Http\Controllers\ArticleController@update');
  Route::get('article/{id}/delete','\App\Http\Controllers\ArticleController@destroy');
  Route::get('article/{id}/deleteMsg','\App\Http\Controllers\ArticleController@DeleteMsg');
});

//tag Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('tag','\App\Http\Controllers\TagController');
  Route::post('tag/{id}/update','\App\Http\Controllers\TagController@update');
  Route::get('tag/{id}/delete','\App\Http\Controllers\TagController@destroy');
  Route::get('tag/{id}/deleteMsg','\App\Http\Controllers\TagController@DeleteMsg');
});
//category Routes
Route::group(['middleware'=> 'web'],function(){
  Route::resource('category','\App\Http\Controllers\CategoryController');
  Route::post('category/{id}/update','\App\Http\Controllers\CategoryController@update');
  Route::get('category/{id}/delete','\App\Http\Controllers\CategoryController@destroy');
  Route::get('category/{id}/deleteMsg','\App\Http\Controllers\CategoryController@DeleteMsg');
});
