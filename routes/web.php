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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@home');
Route::get('/tin-tuc-hoat-dong', 'HomeController@articles')->name('articles');
Route::get('/gioi-thieu', 'HomeController@about')->name('about');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

// middleware: auth
Route::get('/quan-ly/faq', 'FaqController@index')->name('manage.faq');
Route::get('/quan-ly/faq/tao-moi', 'FaqController@create')->name('manage.faq.create');
Route::post('/quan-ly/faq/tao-moi', 'FaqController@store')->name('manage.faq.store');
Route::get('/quan-ly/faq/{id}/sua', 'FaqController@edit')->name('manage.faq.edit');
Route::post('/quan-ly/faq/{id}/sua', 'FaqController@update')->name('manage.faq.update');
Route::get('/quan-ly/faq/{id}/xoa', 'FaqController@destroy')->name('manage.faq.delete');

// middleware: auth
Route::get('/quan-ly/tin-tuc-hoat-dong', 'ArticleController@index')->name('manage.article');
Route::get('/quan-ly/tin-tuc-hoat-dong/tao-moi', 'ArticleController@create')->name('manage.article.create');
Route::post('/quan-ly/tin-tuc-hoat-dong/tao-moi', 'ArticleController@store')->name('manage.article.store');
Route::get('/quan-ly/tin-tuc-hoat-dong/{id}/sua', 'ArticleController@edit')->name('manage.article.edit');
Route::post('/quan-ly/tin-tuc-hoat-dong/{id}/sua', 'ArticleController@update')->name('manage.article.update');
Route::get('/quan-ly/tin-tuc-hoat-dong/{id}/xoa', 'ArticleController@destroy')->name('manage.article.delete');

// middleware: role:admin
Route::get('/quan-ly/nguoi-dung', 'UserController@index')->name('manage.user');
Route::get('/quan-ly/nguoi-dung/tao-moi', 'UserController@create')->name('manage.user.create');
Route::post('/quan-ly/nguoi-dung/tao-moi', 'UserController@store')->name('manage.user.store');
Route::get('/quan-ly/nguoi-dung/{id}/sua', 'UserController@edit')->name('manage.user.edit');
Route::post('/quan-ly/nguoi-dung/{id}/sua', 'UserController@update')->name('manage.user.update');
Route::get('/quan-ly/nguoi-dung/{id}/xoa', 'UserController@destroy')->name('manage.user.delete');