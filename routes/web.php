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

Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('/tin-tuc-hoat-dong', 'Web\HomeController@articles')->name('articles');
Route::get('/gioi-thieu', 'Web\HomeController@about')->name('about');

Route::get('/tin-tuc-hoat-dong/{id}','Web\ArticleController@show')->name('articles.show');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

// middleware: auth
Route::get('/quan-ly/faq', 'Web\FaqController@index')->name('manage.faq');
Route::get('/quan-ly/faq/tao-moi', 'Web\FaqController@create')->name('manage.faq.create');
Route::post('/quan-ly/faq/tao-moi', 'Web\FaqController@store')->name('manage.faq.store');
Route::get('/quan-ly/faq/{id}/sua', 'Web\FaqController@edit')->name('manage.faq.edit');
Route::post('/quan-ly/faq/{id}/sua', 'Web\FaqController@update')->name('manage.faq.update');
Route::get('/quan-ly/faq/{id}/xoa', 'Web\FaqController@destroy')->name('manage.faq.delete');

// middleware: auth
Route::get('/quan-ly/tin-tuc-hoat-dong', 'Web\ArticleController@index')->name('manage.article');
Route::get('/quan-ly/tin-tuc-hoat-dong/tao-moi', 'Web\ArticleController@create')->name('manage.article.create');
Route::post('/quan-ly/tin-tuc-hoat-dong/tao-moi', 'Web\ArticleController@store')->name('manage.article.store');
Route::get('/quan-ly/tin-tuc-hoat-dong/{id}/sua', 'Web\ArticleController@edit')->name('manage.article.edit');
Route::post('/quan-ly/tin-tuc-hoat-dong/{id}/sua', 'Web\ArticleController@update')->name('manage.article.update');
Route::get('/quan-ly/tin-tuc-hoat-dong/{id}/xoa', 'Web\ArticleController@destroy')->name('manage.article.delete');

// middleware: auth
Route::get('/thong-ke/tim-kiem', 'Web\SearchLogController@index')->name('statistics.search_log');

// middleware: role:admin
Route::get('/quan-ly/nguoi-dung', 'Web\UserController@index')->name('manage.user');
Route::get('/quan-ly/nguoi-dung/tao-moi', 'Web\UserController@create')->name('manage.user.create');
Route::post('/quan-ly/nguoi-dung/tao-moi', 'Web\UserController@store')->name('manage.user.store');
Route::get('/quan-ly/nguoi-dung/{id}/sua', 'Web\UserController@edit')->name('manage.user.edit');
Route::post('/quan-ly/nguoi-dung/{id}/sua', 'Web\UserController@update')->name('manage.user.update');
Route::get('/quan-ly/nguoi-dung/{id}/xoa', 'Web\UserController@destroy')->name('manage.user.delete');

Route::get('/tai-khoan/doi-mat-khau', 'Auth\ChangePasswordController@show')->name('auth.password.change.show');
Route::post('/tai-khoan/doi-mat-khau', 'Auth\ChangePasswordController@change')->name('auth.password.change');

Route::get('/danh-ba', 'Web\ContactController@index')->name('contact.index');
Route::get('/quan-ly/danh-ba', 'Web\ContactController@manage')->name('manage.contact')->middleware('auth');
Route::post('/quan-ly/danh-ba/tai-len', 'Web\ContactController@upload')->name('manage.contact.upload')->middleware('auth');